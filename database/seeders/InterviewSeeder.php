<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Interview;

class InterviewSeeder extends Seeder
{
    public function run(): void
    {
        Interview::factory(10)->create();
    }
}
