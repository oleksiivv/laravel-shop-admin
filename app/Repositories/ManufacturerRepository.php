<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductManufacturer;
use App\Models\Speciality;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ManufacturerRepository
{
    public function getById(int $id): Model|null
    {
        return ProductManufacturer::with('products')
            ->find($id);
    }

    public function getAll(): Collection
    {
        return ProductManufacturer::with('products')
            ->get();
    }

    public function getAllSortedByRaiting(): Collection
    {
        return ProductManufacturer::with('products')
            ->orderByDesc('raiting')
            ->get();
    }

    public function getHighestRaited()
    {
        return ProductManufacturer::with('products')
            ->orderByDesc('raiting')
            ->get()->first();
    }

    public function getMostPopular()
    {
        $topManufacturer = DB::select('
            select TOP 1 COUNT([products].[id]) AS products_count, [product_manufacturers].[id] AS manufacturer_id
            from [product_manufacturers]
            left join [products]
            on [product_manufacturers].[id] = [products].[manufacturer_id]
            WHERE [products].[manufacturer_id] IS NOT NULL
            GROUP BY [products].[manufacturer_id], [product_manufacturers].[id]
            ORDER BY products_count DESC
        ')[0];

        return $topManufacturer;
    }

    public function getProducts(int $id): Collection
    {
        return Product::with('productManufacturer')
            ->with('productGuarantee')
            ->with('productCategory')
            ->where('manufacturer_id', $id)
            ->get();
    }

    public function create(array $data): ProductManufacturer
    {
        $manufacturer = new ProductManufacturer();
        $manufacturer->fill($data);

        $manufacturer->information = [
            'address' => $data['address'],
            'site' => $data['site'],
        ];

        $manufacturer->save();

        return $manufacturer;
    }

    public function update(int $id, array $data): ProductManufacturer
    {
        $manufacturer = ProductManufacturer::where('id', $id)->first();
        $manufacturer->fill($data);

        $manufacturer->information = [
            'address' => $data['address'],
            'site' => $data['site'],
        ];

        $manufacturer->save();

        return $manufacturer;
    }

    public function delete(int $id)
    {
        $manufacturer = ProductManufacturer::find($id);

        $manufacturer->delete();
    }

    public function deleteProducts(int $id): ProductManufacturer
    {
        $manufacturer = ProductManufacturer::find($id);

        $manufacturer->products()->delete();

        return $manufacturer;
    }
}
