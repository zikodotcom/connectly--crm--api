<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class projectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'projectName' => $this->faker->sentence(3),
            'dateS' => $this->faker->date(),
            'dateF' => $this->faker->date(),
            'priority' => $this->faker->randomElement(['Low', 'Medium', 'High']),
            'status' => $this->faker->randomElement(['Pending', 'In Progress', 'Completed']),
            'description' => $this->faker->paragraph,
            'amount' => $this->faker->randomFloat(2, 1000, 100000),
            'idC' => \App\Models\Client::factory(), // assuming there is a Client factory
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
