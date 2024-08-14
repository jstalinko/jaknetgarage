<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => rand(1,10),
            'name' => fake()->sentence(),
            'description' => fake()->paragraph(10),
            'price' => rand(100000,10000000),
            'slug' => fake()->slug(),
            'views' => rand(1,100),
            'shopee_url' => fake()->url(),
            'tokopedia_url' => fake()->url(),
            'active'=>true
        ];
    }
}
