<?php

namespace Database\Seeders\ProductionDatabaseSeeders;

use App\Models\Shop;
use App\Models\Speciality;
use App\Models\Worker;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class WorkerSeeder extends Seeder
{
    public function run()
    {
        Worker::factory()
            ->count(10)
            ->create();
    }
}
