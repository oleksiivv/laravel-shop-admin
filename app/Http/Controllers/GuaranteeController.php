<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGuaranteeRequest;
use App\Http\Requests\UpdateGuaranteeRequest;
use App\Models\ProductManufacturer;
use App\Repositories\GuaranteeRepository;
use App\Repositories\ManufacturerRepository;
use App\Repositories\ProductRepository;

class GuaranteeController extends Controller
{
    public function __construct(private GuaranteeRepository $guaranteeRepository)
    {
    }

    public function show(int $id)
    {
        $guarantee = $this->guaranteeRepository->getById($id);

        $products = $this->guaranteeRepository->getProducts($id);

        return view('guaranties', [
            'singleGuarantee' => $guarantee,
            'products' => $products,
        ]);
    }

    public function showAll()
    {
        $guaranties = $this->guaranteeRepository->getAll();

        return view('guaranties', [
            'guaranties' => $guaranties,
        ]);
    }

    public function create(CreateGuaranteeRequest $request)
    {
        $guaranteeId = $this->guaranteeRepository->create($request->toArray())->id;

        return redirect("api/product-guarantee/$guaranteeId");
    }

    public function update(int $id, UpdateGuaranteeRequest $request)
    {
        $guaranteeId = $this->guaranteeRepository->update($id, $request->toArray())->id;

        return redirect("api/product-guarantee/$guaranteeId");
    }

    public function delete(int $id)
    {
        $this->guaranteeRepository->delete($id);

        return redirect("api/product-guarantee");
    }

    public function deleteProducts(int $id)
    {
        $guaranteeId = $this->guaranteeRepository->deleteProducts($id)->id;

        return redirect("api/product-guarantee/$guaranteeId");
    }

    public function showProducts(int $id)
    {
        $guarantee = $this->guaranteeRepository->getById($id);

        $products = $this->guaranteeRepository->getProducts($id);

        return view('guaranties', [
            'singleGuarantee' => $guarantee,
            'products' => $products,
        ]);
    }
}
