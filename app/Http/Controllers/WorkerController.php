<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateShopRequest;
use App\Http\Requests\CreateSpecialityRequest;
use App\Http\Requests\CreateWorkerRequest;
use App\Http\Requests\UpdateShopRequest;
use App\Http\Requests\UpdateWorkerRequest;
use App\Repositories\ShopRepository;
use App\Repositories\SpecialityRepository;
use App\Repositories\WorkerRepository;

class WorkerController extends Controller
{
    public function __construct(
        private ShopRepository $shopRepository,
        private WorkerRepository $workerRepository,
        private SpecialityRepository $specialityRepository,
    ) {
    }

    public function show(int $id)
    {
        return view('workers', [
            'singleWorker' => $this->workerRepository->getById($id),
        ]);
    }

    public function getWorkersByShop(int $shopId)
    {
        return view('workers', [
            'workers' => $this->workerRepository->getWorkersByShop($shopId),
            'shops' => $this->shopRepository->getAll(),
            'currentShopId' => $shopId,
            'specialities' => $this->specialityRepository->getAll(),
        ]);
    }

    public function getWorkersByShopAndSpeciality(int $shopId, int $specialityId)
    {
        return view('workers', [
            'workers' => $this->workerRepository->getWorkersByShopAndSpeciality($shopId, $specialityId),
            'currentShopId' => $shopId,
            'currentSpecialityId' => $specialityId,
            'specialities' => $this->specialityRepository->getAll(),
            'shops' => $this->shopRepository->getAll(),
        ]);
    }

    public function showAll()
    {
        return view('shops', [
            'workers' => $this->workerRepository->getAll(),
            'shops' => $this->shopRepository->getAll(),
        ]);
    }

    public function create(int $shopId, int $specialityId, CreateWorkerRequest $request)
    {
        $workerId = $this->workerRepository->create($request->toArray(), shopId: $shopId, specialityId: $specialityId)->id;

        return redirect("/api/worker/$workerId");
    }

    public function update(int $id, UpdateWorkerRequest $request)
    {
        $workerId = $this->workerRepository->update($id, $request->toArray())->id;

        return redirect("/api/worker/$workerId");
    }

    public function delete(int $id)
    {
        $this->workerRepository->delete($id);

        return redirect("/api/worker");
    }
}
