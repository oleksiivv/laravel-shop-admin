<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateManufacturerRequest;
use App\Http\Requests\UpdateManufacturerRequest;
use App\Models\ProductManufacturer;
use App\Repositories\ManufacturerRepository;
use App\Repositories\ProductRepository;

class ManufacturerController extends Controller
{
    public function __construct(private ManufacturerRepository $manufacturerRepository)
    {
    }

    public function show(int $id)
    {
        $manufacturer = $this->manufacturerRepository->getById($id);

        $products = $this->manufacturerRepository->getProducts($id);

        return view('manufacturers', [
            'singleManufacturer' => $manufacturer,
            'products' => $products,
        ]);
    }

    public function showAll()
    {
        $manufacturers = $this->manufacturerRepository->getAll();

        return view('manufacturers', [
            'manufacturers' => $manufacturers,
        ]);
    }

    public function showProducts(int $id)
    {
        $manufacturer = $this->manufacturerRepository->getById($id);

        $products = $this->manufacturerRepository->getProducts($id);

        return view('manufacturers', [
            'singleManufacturer' => $manufacturer,
            'products' => $products,
        ]);
    }

    public function create(CreateManufacturerRequest $request)
    {
        $manufacturerId = $this->manufacturerRepository->create($request->toArray())->id;

        return redirect("api/product-manufacturer/$manufacturerId");
    }

    public function update(int $id, UpdateManufacturerRequest $request)
    {
        $manufacturerId = $this->manufacturerRepository->update($id, $request->toArray())->id;

        return redirect("api/product-manufacturer/$manufacturerId");
    }

    public function delete(int $id)
    {
        $this->manufacturerRepository->delete($id);

        return redirect('api/product-manufacturer');
    }

    public function deleteProducts(int $id)
    {
        $manufacturerId = $this->manufacturerRepository->deleteProducts($id)->id;

        return redirect("api/product-manufacturer/$manufacturerId");
    }
}
