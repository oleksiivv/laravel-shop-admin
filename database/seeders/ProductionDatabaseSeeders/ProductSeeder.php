<?php

namespace Database\Seeders\ProductionDatabaseSeeders;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Shop;
use App\Models\Speciality;
use App\Models\Worker;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::factory()
            ->count(100)
            ->create();
    }
}
