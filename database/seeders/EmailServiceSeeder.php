<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmailServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\EmailService::factory(10)->create();
    }
}
