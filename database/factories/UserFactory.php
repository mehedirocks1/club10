<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
/**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'bangla_name' => fake()->name(),
            'photo' => fake()->imageUrl(), // Or null if no photo
            'email' => fake()->unique()->safeEmail(),
            'mobile_number' => fake()->phoneNumber(),
            'dob' => fake()->date(),
            'nid' => fake()->numberBetween(1000000000000000, 9999999999999999),
            'gender' => fake()->randomElement(['Male', 'Female', 'Other']),
            'blood_group' => fake()->randomElement(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-']),
            'education' => fake()->randomElement(['Bachelor\'s Degree', 'Master\'s Degree', 'PhD', 'High School']),
            'profession' => fake()->word(),
            'skills' => fake()->words(3, true),
            'country' => 'Bangladesh',
            'division' => fake()->city(),
            'district' => fake()->city(),
            'thana' => fake()->city(),
            'address' => fake()->address(),
            'membership_type' => fake()->randomElement(['Free', 'Premium']),
            'registration_fee' => fake()->randomNumber(4), // You can adjust this to your needs
            'terms_accepted' => fake()->boolean(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'role_id' => 3, // Default role_id for user
            'status' => 1, 
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
