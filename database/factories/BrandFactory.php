<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "image" => fake()->name,
            "name_en" => fake()->name,
            "name_ar" => fake()->name,
            "description_ar" => fake()->name,
            "description_en" => fake()->name,
        ];
    }
}
