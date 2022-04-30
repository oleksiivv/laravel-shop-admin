<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Speciality>
 */
class SpecialityFactory extends Factory
{
    public function definition(): array
    {
        return [
            'speciality_name' => $this->faker->randomElement(
                ['seller', 'warehouseman', 'manager', 'marketer', 'head_of_salesmen_department', 'head_of_warehouse']
            ),
        ];
    }
}
