<?php

namespace App\Repositories;

use App\Models\Promotion;
use App\Models\Shop;
use App\Models\Worker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class WorkerRepository
{
    public function getById(int $id): Model|null
    {
        return Worker::with('shop')->with('speciality')->find($id);
    }

    public function getWorkersByShop(int $shopId): Collection
    {
        return Worker::with('shop')
            ->with('speciality')
            ->where('shop_id', $shopId)
            ->get();
    }

    public function getWorkerByEmail(string $email): \Illuminate\Database\Eloquent\Builder|Model
    {
        return Worker::with('shop')
            ->with('speciality')
            ->where([
                ['email', '=', $email]
            ])
            ->firstOrFail();
    }

    public function getWorkersByShopAndSpeciality(int $shopId, int $specialityId): Collection
    {
        return Worker::with('shop')
            ->with('speciality')
            ->where(
                [
                    ['speciality_id', '=', $specialityId],
                    ['shop_id', '=', $shopId]
                ],
            )
            ->get();
    }

    public function getAll(): Collection
    {
        return Worker::with('shop')->with('speciality')->get();
    }

    public function create(array $data, int $shopId = null, int $specialityId = null): Worker
    {
        $worker = new Worker();
        $worker->fill($data);

        $worker->shop_id = $shopId;
        $worker->speciality_id = $specialityId;

        $worker->save();

        return $worker;
    }

    public function update(int $id, array $data): Worker
    {
        $worker = Worker::where('id', $id)->first();
        $worker->fill($data);

        $worker->save();

        return $worker;
    }

    public function delete(int $id)
    {
        $worker = Worker::find($id);

        $worker->delete();
    }
}
