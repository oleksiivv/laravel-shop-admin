<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\CreateSpecialityRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Requests\UpdateSpecialityRequest;
use App\Models\Shop;
use App\Models\Speciality;
use App\Repositories\ShopRepository;
use App\Repositories\SpecialityRepository;

class SpecialityController extends Controller
{
    public function __construct(private SpecialityRepository $specialityRepository)
    {
    }

    public function show(int $id)
    {
        return view('specialities', [
            'singleSpeciality' => $this->specialityRepository->getById($id),
        ]);
    }

    public function showAll()
    {
        return view('specialities', [
            'specialities' => $this->specialityRepository->getAll(),
        ]);
    }

    public function create(CreateSpecialityRequest $request)
    {
        $specialityId = $this->specialityRepository->create($request->toArray())->id;

        return redirect("/api/worker-speciality/$specialityId");
    }

    public function update(int $id, UpdateSpecialityRequest $request)
    {
        $specialityId = $this->specialityRepository->update($id, $request->toArray())->id;

        return redirect("/api/worker-speciality/$specialityId");
    }

    public function delete(int $id)
    {
        $this->specialityRepository->delete($id);

        return redirect("/api/worker-speciality");
    }

    public function deleteWorkers(int $id)
    {
        $this->specialityRepository->deleteWorkers($id);

        return redirect("/api/worker-speciality");
    }
}
