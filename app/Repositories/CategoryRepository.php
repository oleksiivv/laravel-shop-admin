<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductGuarantee;
use App\Models\ProductManufacturer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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

    public function getMostPopular()
    {
        $topCategory = DB::select('
            select TOP 1 COUNT([products].[id]) AS products_count, [product_categories].[id] AS category_id
            from [product_categories]
            left join [products]
            on [product_categories].[id] = [products].[category_id]
            WHERE [products].[category_id] IS NOT NULL
            GROUP BY [products].[category_id], [product_categories].[id]
            ORDER BY products_count DESC
        ')[0];

        return $topCategory;
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
