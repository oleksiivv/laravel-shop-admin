<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductGuarantee;
use App\Models\ProductManufacturer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CategoryRepository
{
    public function getById(int $id): Model|null
    {
        return ProductCategory::with('products')
            ->find($id);
    }

    public function getAll(): Collection
    {
        return ProductCategory::with('products')
            ->get();
    }

    public function create(array $data): ProductCategory
    {
        $category = new ProductCategory();
        $category->fill($data);

        $category->save();

        return $category;
    }

    public function update(int $id, array $data): ProductCategory
    {
        $category = ProductCategory::where('id', $id)->first();
        $category->fill($data);

        $category->save();

        return $category;
    }

    public function delete(int $id)
    {
        $guarantee = ProductGuarantee::find($id);

        $guarantee->delete();
    }

    public function deleteProducts(int $id): ProductCategory
    {
        $productCategory = ProductCategory::find($id);

        $productCategory->products()->delete();

        return $productCategory;
    }

    public function getProducts(int $id): Collection
    {
        return Product::with('productManufacturer')
            ->with('productGuarantee')
            ->with('productCategory')
            ->where('category_id', $id)
            ->get();
    }
}
