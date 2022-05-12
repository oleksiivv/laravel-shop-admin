<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\ProductManufacturer;
use App\Models\Shop;
use App\Models\Worker;
use App\Repositories\CategoryRepository;
use App\Repositories\GuaranteeRepository;
use App\Repositories\ManufacturerRepository;
use App\Repositories\ShopRepository;
use App\Repositories\WorkerRepository;

class MainController extends Controller
{
    public function __construct(
        private ShopRepository $shopRepository,
        private CategoryRepository $categoryRepository,
        private ManufacturerRepository $manufacturerRepository,
        private WorkerRepository $workerRepository,
        private GuaranteeRepository $guaranteeRepository,
    ) {
    }

    public function home()
    {
        $bestWorker = $this->workerRepository->getWithMostSales();

        $mostVisitedShop = $this->shopRepository->getMostOftenVisited();

        return view('home', [
            'bestWorker' => $bestWorker,
            'mostVisitedShop' => $mostVisitedShop,
            'shopsAddress' => $this->shopRepository->getAll()->map(function (Shop $shop) {
                return $shop->address;
            })->toArray(),
            'workersInShopsStats' => $this->shopRepository->getAll()->map(function (Shop $shop) {
                return $shop->workers->count();
            })->toArray(),
            'categories' => $this->categoryRepository->getAll()->map(function (ProductCategory $category) {
                return $category->name;
            })->toArray(),
            'productsInCategoriesStats' => $this->categoryRepository->getAll()->map(function (ProductCategory $category) {
                return $category->products->count();
            })->toArray(),
            'manufacturers' => $this->manufacturerRepository->getAll()->map(function (ProductManufacturer $manufacturer) {
                return $manufacturer->name;
            })->toArray(),
            'manufacturersRaitings' => $this->manufacturerRepository->getAll()->map(function (ProductManufacturer $manufacturer) {
                return $manufacturer->raiting;
            })->toArray(),
            'productsInManufacturersStats' => $this->manufacturerRepository->getAll()->map(function (ProductManufacturer $manufacturer) {
                return $manufacturer->products->count();
            })->toArray(),
            'workers' => array_values($this->workerRepository->getAll()->filter(function (Worker $worker) {
                    return $worker->carts->count() > 0;
                })->map(function (Worker $worker) {
                    return $worker->email;
                })->toArray()),
            'workersSalesStats' => array_values($this->workerRepository->getAll()->map(function (Worker $worker) {
                return $worker->carts->count();
            })->filter(function ($count) {
                return $count>0;
            })->toArray()),
            'sortedManufacturers' => $this->manufacturerRepository->getAllSortedByRaiting(),
            'bestManufacturer' => $this->manufacturerRepository->getHighestRaited(),
            'mostPopularManufacturer' => $this->manufacturerRepository->getMostPopular(),
            'mostPopularCategory' => $this->categoryRepository->getMostPopular(),
            'mostPopularGuarantee' => $this->guaranteeRepository->getMostPopular(),
        ]);
    }

    public function manageProducts()
    {
        return view('products_manage');
    }

    public function manageShops()
    {
        return view('shops_manage');
    }

    public function manageCarts()
    {
        return view('carts_manage');
    }
}
