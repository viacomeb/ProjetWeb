<?php

namespace Database\Seeders;

use App\Models\Intern;
use Illuminate\Database\Seeder;

class InternSeeder extends Seeder
{
    public function run(): void
    {
        Intern::factory()->count(10)->create();
    }
}
