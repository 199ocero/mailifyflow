<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CampaignEmail>
 */
class CampaignEmailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject' => fake()->text(50),
            'from_name' => fake()->text(50),
            'from_email' => fake()->text(50),
            'open_count' => fake()->randomNumber(),
            'click_count' => fake()->randomNumber(),

        ];
    }
}
