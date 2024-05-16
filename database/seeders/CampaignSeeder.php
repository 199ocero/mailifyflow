<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Campaign::factory(10)->create();
    }
}
