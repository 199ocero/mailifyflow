<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SubscriberTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\SubscriberTag::factory(10)->create();
    }
}
