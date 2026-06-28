<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class ItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'item_name' => fake()->word(),
            'price' => fake()->numberBetween(10000, 50000),
            'stock' => fake()->numberBetween(1, 100),
            'category_id' => Category::factory(),
        ];
    }
}