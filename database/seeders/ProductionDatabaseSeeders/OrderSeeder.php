<?php

namespace Database\Seeders\ProductionDatabaseSeeders;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\Shop;
use App\Models\Speciality;
use App\Models\Worker;
use Database\Factories\SpecialityFactory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run()
    {
        Order::factory()
            ->count(4)->create();
    }
}
