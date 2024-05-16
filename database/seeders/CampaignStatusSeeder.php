<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CampaignStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\CampaignStatus::factory(10)->create();
    }
}
