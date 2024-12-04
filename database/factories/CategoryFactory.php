<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name_en" => fake()->name,
            "name_ar" => fake()->name,
            "description_en" => fake()->sentence(15),
            "description_ar" => fake()->sentence(15),
        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (Category $category) {
            Category::create([
                "parent_id" => $category->id,
                "name_en" => fake()->name,
                "name_ar" => fake()->name,
                "description_en" => fake()->sentence(15),
                "description_ar" => fake()->sentence(15),
            ]);
        });
    }
}
