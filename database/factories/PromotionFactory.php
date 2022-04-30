<?php

namespace Database\Factories;

use App\Models\CartItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop>
 */
class PromotionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'coupon' => $this->faker->unique()->text(5),
            'description' => $this->faker->text(70),
            'amount' => $this->faker->numberBetween(10.5, 99.99),
            'cart_item_id' => $this->faker->randomElement(CartItem::all())->id ?? null,
        ];
    }
}
