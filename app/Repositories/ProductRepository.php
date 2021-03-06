<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ProductRepository
{
    public function getById(int $id): Model|null
    {
        return Product::with('productCategory')
            ->with('productManufacturer')
            ->with('productGuarantee')
            ->find($id);
    }

    public function getInAlphabeticOrder(): Collection
    {
        return Product::with('productCategory')
            ->with('productManufacturer')
            ->with('productGuarantee')
            ->orderBy('name')
            ->get();
    }

    public function getProductsByCategoryId(int $categoryId): Collection
    {
        return Product::with('productCategory')
            ->with('productManufacturer')
            ->with('productGuarantee')
            ->where('category_id', $categoryId)
            ->get();
    }

    public function getProductsByCategoryIdAndManufacturerId(int $categoryId, int $manufacturerId): Collection
    {
        return Product::with('productCategory')
            ->with('productManufacturer')
            ->with('productGuarantee')
            ->where([
                ['category_id', '=', $categoryId],
                ['manufacturer_id', '=', $manufacturerId],
            ])
            ->get();
    }

    public function getProductsByCategoryIdAndManufacturerIdAndGuaranteeId(int $categoryId, int $manufacturerId, int $guaranteeId): Collection
    {
        return Product::with('productCategory')
            ->with('productManufacturer')
            ->with('productGuarantee')
            ->where([
                ['category_id', '=', $categoryId],
                ['manufacturer_id', '=', $manufacturerId],
                ['guarantee_id', '=', $guaranteeId],
            ])
            ->get();
    }

    public function getAll(?string $categoryId=null, ?string $manufacturerId=null, ?string $guaranteeId=null): Collection
    {
        $queryFilters = [];

        $queryFilters['category_id'] = $categoryId;
        $queryFilters['manufacturer_id'] = $manufacturerId;
        $queryFilters['guarantee_id'] = $guaranteeId;

        $queryFilters = array_filter($queryFilters);

        return Product::with('productCategory')
            ->with('productManufacturer')
            ->with('productGuarantee')
            ->where($queryFilters)
            ->get();
    }

    public function create(array $data, int $categoryId = null, int $manufacturerId = null, int $guaranteeId = null): Product
    {
        $product = new Product();
        $product->fill($data);

        $product->category_id = $categoryId;
        $product->manufacturer_id = $manufacturerId;
        $product->guarantee_id = $guaranteeId == -1 ? null : $guaranteeId;

        $product->information = [
            'description' => $data['description'],
        ];

        $product->save();

        return $product;
    }

    public function update(int $id, array $data, int $categoryId = null): Product
    {
        $product = Product::where('id', $id)->first();
        $product->fill($data);

        $product->information = [
            'description' => $data['description'],
        ];

        $product->save();

        return $product;
    }

    public function delete(int $id)
    {
        $product = Product::find($id);

        $product->delete();
    }
}
