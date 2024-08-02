<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class clientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image' => $this->faker->imageUrl(640, 480, 'business', true, 'Faker'),
            'clientName' => $this->faker->company,
            'email' => $this->faker->unique()->companyEmail,
            'phone' => $this->faker->phoneNumber,
            'website' => $this->faker->url,
            'owner' => $this->faker->name,
            'industry' => $this->faker->word,
            'currency' => $this->faker->currencyCode,
            'languages' => $this->faker->languageCode,
            'description' => $this->faker->paragraph,
            'adresse' => $this->faker->address,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'country' => $this->faker->country,
            'zipCode' => $this->faker->postcode,
            'facebook' => $this->faker->url,
            'linkedin' => $this->faker->url,
            'twitter' => $this->faker->url,
            'instgram' => $this->faker->url,
            'whatsapp' => $this->faker->phoneNumber,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
