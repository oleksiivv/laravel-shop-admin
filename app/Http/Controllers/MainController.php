<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\ProductManufacturer;
use App\Models\Shop;
use App\Models\Worker;
use App\Repositories\CategoryRepository;
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
    ) {
    }

    public function home()
    {
        return view('home', [
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
            'workers' => $this->workerRepository->getAll()->map(function (Worker $worker) {
                return $worker->email;
            })->toArray(),
            'workersSalesStats' => $this->workerRepository->getAll()->map(function (Worker $worker) {
                return $worker->carts->count();
            })->toArray(),
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
