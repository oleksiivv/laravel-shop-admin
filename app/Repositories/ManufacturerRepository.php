<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductManufacturer;
use App\Models\Speciality;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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

        $manufacturer->information = json_encode([
            'address' => $data['address'],
            'site' => $data['site'],
        ]);

        $manufacturer->save();

        return $manufacturer;
    }

    public function update(int $id, array $data): ProductManufacturer
    {
        $manufacturer = ProductManufacturer::where('id', $id)->first();
        $manufacturer->fill($data);

        $manufacturer->information = json_encode([
            'address' => $data['address'],
            'site' => $data['site'],
        ]);

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
