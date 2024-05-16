<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UnsubscribeEventTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\UnsubscribeEventType::factory(10)->create();
    }
}
