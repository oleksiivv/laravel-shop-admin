<?php

namespace Database\Seeders\ProductionDatabaseSeeders;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Promotion;
use App\Models\Shop;
use App\Models\Speciality;
use App\Models\Worker;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class CartItemSeeder extends Seeder
{
    public function run()
    {
        CartItem::factory()
            ->count(100)
            ->has(Promotion::factory()->count(2))
            ->create();
    }
}
