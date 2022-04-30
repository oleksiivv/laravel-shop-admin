<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Speciality;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_FAILED = 'failed';
    public const STATUS_PAYMENT_FAILED = 'payment_failed';
    public const STATUS_PENDING = 'pending';

    public function definition(): array
    {
        return [
            'cart' => json_encode([]),
            'total_price' => $this->faker->numberBetween(10.5, 1500.99),
            'status' => self::STATUS_COMPLETED,
            'customer_id' => $this->faker->unique(true)->randomElement(Customer::all())->id ?? null,
        ];
    }
}
