<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use App\Models\ProductGuarantee;
use App\Models\ProductManufacturer;
use App\Models\Shop;
use App\Models\Speciality;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'information' => [
                'description' => $this->faker->text()
            ],
            'current_price' => $this->faker->numberBetween(10.5, 350.99),
            'category_id' => $this->faker->randomElement(ProductCategory::all())->id,
            'manufacturer_id' => $this->faker->randomElement(ProductManufacturer::all())->id,
            'guarantee_id' => $this->faker->randomElement(ProductGuarantee::all())->id,
        ];
    }
}
