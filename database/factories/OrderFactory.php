<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Speciality;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'cart' => [],
            'total_price' => $this->faker->numberBetween(10.5, 1500.99),
            'status' => Order::STATUS_SUCCESS,
            'customer_id' => $this->faker->unique(true)->randomElement(Customer::all())->id ?? null,
        ];
    }
}
