<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\GetProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\GuaranteeRepository;
use App\Repositories\ManufacturerRepository;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    public function __construct(
        private ProductRepository $productRepository,
        private CategoryRepository $categoryRepository,
        private GuaranteeRepository $guaranteeRepository,
        private ManufacturerRepository $manufacturerRepository,
    ) {
    }

    public function show(int $id)
    {
        $product = $this->productRepository->getById($id);

        return view('product', [
            'singleProduct' => $product,
        ]);
    }

    public function getProductsByCategoryId(int $categoryId)
    {
        $products = $this->productRepository->getProductsByCategoryId($categoryId);

        $categories = $this->categoryRepository->getAll();
        $manufacturers = $this->manufacturerRepository->getAll();
        $guaranties = $this->guaranteeRepository->getAll();

        return view('product', [
            'products' => $products,
            'currentCategoryId' => $categoryId,
            'manufacturers' => $manufacturers,
            'guaranties' => $guaranties,
            'categories' => $categories,
        ]);
    }

    public function getProductsByCategoryIdAndManufacturerId(int $categoryId, int $manufacturerId)
    {
        $products = $this->productRepository->getProductsByCategoryIdAndManufacturerId($categoryId, $manufacturerId);

        $categories = $this->categoryRepository->getAll();
        $manufacturers = $this->manufacturerRepository->getAll();
        $guaranties = $this->guaranteeRepository->getAll();

        return view('product', [
            'products' => $products,
            'currentCategoryId' => $categoryId,
            'currentManufacturerId' => $manufacturerId,
            'manufacturers' => $manufacturers,
            'guaranties' => $guaranties,
            'categories' => $categories,
        ]);
    }

    public function getProductsByCategoryIdAndManufacturerIdAndGuaranteeId(int $categoryId, int $manufacturerId, int $guaranteeId)
    {
        $products = $this->productRepository->getProductsByCategoryIdAndManufacturerIdAndGuaranteeId($categoryId, $manufacturerId, $guaranteeId);

        $categories = $this->categoryRepository->getAll();
        $manufacturers = $this->manufacturerRepository->getAll();
        $guaranties = $this->guaranteeRepository->getAll();

        return view('product', [
            'products' => $products,
            'currentCategoryId' => $categoryId,
            'currentManufacturerId' => $manufacturerId,
            'currentGuaranteeId' => $guaranteeId,
            'manufacturers' => $manufacturers,
            'guaranties' => $guaranties,
            'categories' => $categories,
        ]);
    }

    public function showAll(GetProductRequest $request)
    {
        $filter = $request->toArray();

        $categoryId = data_get($filter, 'category');
        $manufacturerId = data_get($filter, 'manufacturer');
        $guaranteeId = data_get($filter, 'guaranty');

        $products = $this->productRepository->getAll($categoryId, $manufacturerId, $guaranteeId);

        $manufacturers = $this->manufacturerRepository->getAll();
        $categories = $this->categoryRepository->getAll();
        $guaranties = $this->guaranteeRepository->getAll();

        return view('product', [
            'products' => $products,
            'manufacturers' => $manufacturers,
            'guaranties' => $guaranties,
            'categories' => $categories,
            'currentCategoryId' => $categoryId,
            'currentManufacturerId' => $manufacturerId,
            'currentGuaranteeId' => $guaranteeId,
        ]);
    }

    public function create(CreateProductRequest $request)
    {
        $productId = $this->productRepository->create($request->toArray())->id;

        return redirect("api/product/$productId");
    }

    public function update(int $id, UpdateProductRequest $request)
    {
        $productId = $this->productRepository->update($id, $request->toArray())->id;

        return redirect("api/product/$productId");
    }

    public function createWithCategory(int $categoryId, CreateProductRequest $request) //ToDo
    {
        $this->productRepository->create($request->toArray(), $categoryId);
    }

    public function updateWithCategory(int $categoryId, UpdateProductRequest $request)
    {
        $this->productRepository->update($categoryId, $request->toArray());
    }

    public function createWithCategoryAndManufacturerAndGuarantee(int $categoryId, int $manufacturerId, int $guaranteeId, CreateProductRequest $request)
    {
        $productId = $this->productRepository->create($request->toArray(), $categoryId, $manufacturerId, $guaranteeId)->id;

        return redirect("api/product/$productId");
    }

    public function delete(int $id)
    {
        $this->productRepository->delete($id);

        return redirect('api/product');
    }
}
