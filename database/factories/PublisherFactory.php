<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publisher>
 */
class PublisherFactory extends Factory
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
            'description' => fake()->text(),
            'logo_url' => fake()->url(),
            'creator_id' => 1,
        ];
    }

    public function creator($userId)
    {
        return $this->state(function (array $attributes) use ($userId) {
            return [
                'creator_id' => $userId,
            ];
        });
    }
}
