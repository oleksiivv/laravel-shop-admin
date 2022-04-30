<?php

namespace App\Repositories;

use App\Models\Promotion;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ShopRepository
{
    public function getById(int $id): Model|null
    {
        return Shop::with('workers')->with('workers.speciality')->find($id);
    }

    public function getAll(): Collection
    {
        return Shop::with('workers')->with('workers.speciality')->get();
    }

    public function create(array $data): Shop
    {
        $shop = new Shop();
        $shop->fill($data);

        $shop->save();

        return $shop;
    }

    public function update(int $id, array $data): void
    {
        $shop = Shop::where('id', $id)->first();
        $shop->fill($data);

        $shop->save();
    }

    public function delete(int $id)
    {
        $shop = Shop::find($id);

        $shop->delete();
    }

    public function deleteWorkers(int $id)
    {
        $shop = Shop::find($id);

        $shop->workers()->delete();
    }
}
