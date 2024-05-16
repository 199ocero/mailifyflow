<?php

namespace Database\Seeders;

use App\Models\CampaignStatus;
use App\Models\EmailProviderType;
use App\Models\UnsubscribeEventType;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $campaignStatuses = ['Draft', 'Queued', 'Sending', 'Sent', 'Cancelled'];

        foreach ($campaignStatuses as $campaignStatus) {
            CampaignStatus::factory()->create(['name' => $campaignStatus]);
        }

        $emailProviderTypes = ['SMTP']; // add more in the future

        foreach ($emailProviderTypes as $emailProviderType) {
            EmailProviderType::factory()->create(['name' => $emailProviderType]);
        }

        $unsubscribeEventTypes = ['Bounce', 'Complaint', 'Manual by Admin', 'Manual by Subscriber'];

        foreach ($unsubscribeEventTypes as $unsubscribeEventType) {
            UnsubscribeEventType::factory()->create(['name' => $unsubscribeEventType]);
        }
    }
}
