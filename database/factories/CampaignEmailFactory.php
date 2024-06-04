<?php

namespace Database\Factories;

use App\Enum\CampaignLogStatusType;
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
            'team_id' => 1,
            'campaign_id' => 1,
            'subscriber_id' => 1,
            'subscriber_email' => $this->faker->email,
            'subscriber_first_name' => $this->faker->firstName,
            'subscriber_last_name' => $this->faker->lastName,
            'status' => CampaignLogStatusType::SENT->value,
            'reason_failed' => null,
            'open_count' => 0,
            'click_count' => 0,
            'queued_at' => now(),
            'sent_at' => now(),
            'delivered_at' => now(),
            'bounced_at' => null,
            'unsubscribed_at' => null,
            'complained_at' => null,
            'rejected_at' => null,
            'rendering_failure_at' => null,
            'delivery_delay_at' => null,
            'opened_at' => null,
            'clicked_at' => null,
        ];
    }
}
