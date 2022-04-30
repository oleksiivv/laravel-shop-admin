<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductGuarantee>
 */
class ProductGuaranteeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->name(),
            'description' => $this->faker->text(),
            'valid_from' => now(),
            'valid_till' => now()->addMonths($this->faker->numberBetween(6, 36)),
        ];
    }
}
