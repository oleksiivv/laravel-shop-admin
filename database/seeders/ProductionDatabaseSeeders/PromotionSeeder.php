<?php

namespace Database\Seeders\ProductionDatabaseSeeders;

use App\Models\Promotion;
use App\Models\Shop;
use App\Models\Speciality;
use App\Models\Worker;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    public function run()
    {
        Promotion::factory()
            ->count(10)
            ->create();
    }
}
