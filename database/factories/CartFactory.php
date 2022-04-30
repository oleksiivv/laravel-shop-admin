<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Shop;
use App\Models\Speciality;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_FAILED = 'failed';
    public const STATUS_PENDING = 'pending';

    public function definition(): array
    {
        return [
            'seller_id' => null,
            'customer_id' => $this->faker->unique(true)->randomElement(Customer::all())->id ?? null,
            'status' => self::STATUS_COMPLETED,
        ];
    }
}
