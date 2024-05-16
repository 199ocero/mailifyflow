<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmailProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\EmailProvider::factory(10)->create();
    }
}
