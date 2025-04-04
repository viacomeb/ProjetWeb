<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pilot;

class PilotSeeder extends Seeder
{
    public function run(): void
    {
        Pilot::factory(5)->create();
    }
}
