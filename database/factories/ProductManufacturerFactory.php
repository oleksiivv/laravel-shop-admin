<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductManufacturer>
 */
class ProductManufacturerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->company(),
            'information' => [
                'address' => $this->faker->unique()->address(),
                'site' => $this->faker->unique()->url(),
            ],
            'raiting' => $this->faker->numberBetween(0.0, 5.0),
        ];
    }
}
