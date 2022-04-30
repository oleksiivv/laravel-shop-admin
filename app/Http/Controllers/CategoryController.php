<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\ProductManufacturer;
use App\Repositories\CategoryRepository;
use App\Repositories\ManufacturerRepository;
use App\Repositories\ProductRepository;

class CategoryController extends Controller
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    public function show(int $id)
    {
        $category = $this->categoryRepository->getById($id);

        $products = $this->categoryRepository->getProducts($id);

        return view('categories', [
            'singleCategory' => $category,
            'products' => $products,
        ]);
    }

    public function showAll()
    {
        $categories = $this->categoryRepository->getAll();

        return view('categories', [
            'categories' => $categories,
        ]);
    }

    public function create(CreateCategoryRequest $request)
    {
        $categoryId = $this->categoryRepository->create($request->toArray())->id;

        return redirect("api/product-category/$categoryId");
    }

    public function update(int $id, UpdateCategoryRequest $request)
    {
        $categoryId = $this->categoryRepository->update($id, $request->toArray())->id;

        return redirect("api/product-category/$categoryId");
    }

    public function showProducts(int $id)
    {
        $category = $this->categoryRepository->getById($id);

        $products = $this->categoryRepository->getProducts($id);

        return view('categories', [
            'singleCategory' => $category,
            'products' => $products,
        ]);
    }

    public function delete(int $id)
    {
        $this->categoryRepository->delete($id);

        return redirect('api/product-category');
    }

    public function deleteProducts(int $id)
    {
        $categoryId = $this->categoryRepository->deleteProducts($id)->id;

        return redirect("api/product-category/$categoryId");
    }
}
