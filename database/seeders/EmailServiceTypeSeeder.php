<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmailServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\EmailServiceType::factory(10)->create();
    }
}
