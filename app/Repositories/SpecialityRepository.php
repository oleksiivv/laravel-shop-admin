<?php

namespace App\Repositories;

use App\Models\Promotion;
use App\Models\Shop;
use App\Models\Speciality;
use App\Models\Worker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class SpecialityRepository
{
    public function getById(int $id): Model|null
    {
        return Speciality::with('workers')->find($id);
    }

    public function getAll(): Collection
    {
        return Speciality::with('workers')->get();
    }

    public function create(array $data): Speciality
    {
        $speciality = new Speciality();
        $speciality->fill($data);

        $speciality->save();

        return $speciality;
    }

    public function update(int $id, array $data): Speciality
    {
        $speciality = Speciality::where('id', $id)->first();
        $speciality->fill($data);

        $speciality->save();

        return $speciality;
    }

    public function delete(int $id)
    {
        $shop = Speciality::find($id);

        $shop->delete();
    }

    public function deleteWorkers(int $id)
    {
        $shop = Speciality::find($id);

        $shop->workers()->delete();
    }
}
