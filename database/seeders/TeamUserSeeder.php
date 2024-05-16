<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TeamUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\TeamUser::factory(10)->create();
    }
}
