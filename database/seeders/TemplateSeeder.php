<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Template::factory(10)->create();
    }
}
