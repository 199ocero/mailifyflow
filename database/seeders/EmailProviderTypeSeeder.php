<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmailProviderTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\EmailProviderType::factory(10)->create();
    }
}
