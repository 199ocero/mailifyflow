<?php

namespace Database\Seeders;

use App\Models\CampaignStatus;
use App\Models\EmailServiceType;
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

        $emailServiceTypes = ['SMTP']; // add more in the future

        foreach ($emailServiceTypes as $emailServiceType) {
            EmailServiceType::factory()->create(['name' => $emailServiceType]);
        }

        $unsubscribeEventTypes = ['Bounce', 'Complaint', 'Manual by Admin', 'Manual by Subscriber'];

        foreach ($unsubscribeEventTypes as $unsubscribeEventType) {
            UnsubscribeEventType::factory()->create(['name' => $unsubscribeEventType]);
        }
    }
}
