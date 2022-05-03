<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Shop;
use App\Models\Speciality;
use App\Models\Worker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    public function definition(): array
    {
        return [
            'seller_id' => $this->faker->unique(true)->randomElement(Worker::all())->id ?? null,
            'customer_id' => $this->faker->unique(true)->randomElement(Customer::all())->id ?? null,
            'status' => Cart::STATUS_CREATED,
        ];
    }
}
