<?php

namespace Database\Seeders\ProductionDatabaseSeeders;

use App\Models\Shop;
use App\Models\Speciality;
use App\Models\Worker;
use Database\Factories\SpecialityFactory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    public function run()
    {
        Shop::factory()
            ->has(
                Worker::factory()->count(6)
            )
            ->count(10)->create();
    }
}
