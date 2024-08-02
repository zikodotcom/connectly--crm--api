<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fullName' => $this->faker->name,
            'userName' => $this->faker->userName,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'nationality' => $this->faker->country,
            'adresse' => $this->faker->address,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'zipCode' => $this->faker->postcode,
            'country' => $this->faker->country,
            'photo' => $this->faker->imageUrl($width = 640, $height = 480),
            'role' => $this->faker->jobTitle,
            'salary' => $this->faker->randomFloat(2, 30000, 100000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
