<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmailList>
 */
class EmailListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'team_id' => 1,
            'name' => fake()->text(50),
            'description' => fake()->text(100),
            'active' => true,
            'default' => true,
        ];
    }
}
