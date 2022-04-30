<?php

namespace Database\Seeders\ProductionDatabaseSeeders;

use App\Models\ProductCategory;
use App\Models\ProductManufacturer;
use App\Models\Shop;
use App\Models\Speciality;
use App\Models\Worker;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ProductManufacturerSeeder extends Seeder
{
    public function run()
    {
        ProductManufacturer::factory()
            ->count(10)
            ->create();
    }
}
