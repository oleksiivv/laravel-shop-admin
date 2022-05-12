<?php

namespace App\Repositories;

use App\Models\Promotion;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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

    public function getMostOftenVisited()
    {
        $shopData = DB::select('
            SELECT TOP 1 a.shop_id, COUNT(a.carts_count) as carts_count FROM
            (SELECT COUNT([carts].[seller_id]) AS carts_count, [workers].[id] AS worker_id, [workers].[shop_id] from [workers]
            LEFT JOIN [carts]
            ON [workers].[id] = [carts].[seller_id]
            WHERE [carts].[seller_id] IS NOT NULL
            GROUP BY [carts].[seller_id], [workers].[id], [workers].[shop_id]) a
            GROUP BY a.shop_id
            ORDER BY carts_count DESC;
        ')[0];

        return $shopData;
    }
}
