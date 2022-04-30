<?php

namespace Database\Factories;

use App\Models\Shop;
use App\Models\Speciality;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Worker>
 */
class WorkerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->email(),
            'month_of_experience' => $this->faker->randomDigitNotNull(),
            'speciality_id' => $this->faker->unique(true)->randomElement(Speciality::all())->id,
        ];
    }
}
