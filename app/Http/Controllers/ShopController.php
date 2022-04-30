<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\CreateShopRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Requests\UpdateShopRequest;
use App\Repositories\ShopRepository;
use App\Repositories\SpecialityRepository;

class ShopController extends Controller
{
    public function __construct(
        private ShopRepository $shopRepository,
        private SpecialityRepository $specialityRepository,
    ) {
    }

    public function show(int $id)
    {
        return view('shops', [
            'singleShop' => $this->shopRepository->getById($id),
            'specialities' => $this->specialityRepository->getAll(),
            'currentShopId' => $id,
        ]);
    }

    public function showAll()
    {
        return view('shops', [
            'shops' => $this->shopRepository->getAll(),
        ]);
    }

    public function create(CreateShopRequest $request)
    {
        $shopId = $this->shopRepository->create($request->toArray())->id;

        return redirect("/api/shop/$shopId");
    }

    public function update(int $id, UpdateShopRequest $request)
    {
        $this->shopRepository->update($id, $request->validated());

        return redirect("/api/shop/$id");
    }

    public function delete(int $id)
    {
        $this->shopRepository->delete($id);

        return redirect("/api/shop");
    }

    public function deleteWorkers(int $id)
    {
        $this->shopRepository->deleteWorkers($id);

        return redirect("/api/shop/$id");
    }
}
