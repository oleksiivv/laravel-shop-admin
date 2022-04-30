<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductGuarantee;
use App\Models\ProductManufacturer;
use App\Models\Promotion;
use App\Models\Shop;
use App\Models\Speciality;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartItem>
 */
class CartItemFactory extends Factory
{
    public function definition(): array
    {
        $products = Product::all();
        return [
            'price' => $this->faker->numberBetween(10, 500),
            'cart_id' => null,
            'product_id' => $this->faker->randomElement($products)->id,
        ];
    }
}
