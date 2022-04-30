<?php

namespace Database\Seeders\ProductionDatabaseSeeders;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Shop;
use App\Models\Speciality;
use App\Models\Worker;
use Database\Factories\SpecialityFactory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    public function run()
    {
        $carts = Cart::factory()
            ->has(
                CartItem::factory()->count(3)->has(Promotion::factory()->count(2))
            )
            ->count(4)->create();

        Order::factory()
            ->count(2)
            ->state(new Sequence(
                ['cart' => json_encode($carts[0]->toArray())],
                ['cart' => json_encode($carts[1]->toArray())],
                ['cart' => json_encode($carts[2]->toArray())],
                ['cart' => json_encode($carts[3]->toArray())],
            ))
            ->create();
    }
}
