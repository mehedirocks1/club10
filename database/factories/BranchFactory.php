<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Branch>
 */
class BranchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'description' => $this->faker->sentence,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'working_hours' => 'Mon-Fri, 9 AM - 6 PM',
            'image' => $this->faker->imageUrl(640, 480, 'business', true, 'branch'), // Dynamic image URL
        ];
    }
}
