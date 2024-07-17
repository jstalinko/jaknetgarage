<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Testimonial>
 */
class TestimonialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'service' => fake()->randomElement(['servis motor','modif motor','ganti oli','tambal ban']),
            'content' => fake()->paragraph(),
            'star' => rand(3,5)
        ];
    }
}
