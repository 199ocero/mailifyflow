<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CampaignEmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\CampaignEmail::factory(10)->create();
    }
}
