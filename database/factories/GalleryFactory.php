<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gallery>
 */
class GalleryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image' => 'assets/images/gallery-' . $this->faker->numberBetween(1, 10) . '.jpg', // Dynamic image path
            'description' => $this->faker->sentence,
        ];
    }
}
