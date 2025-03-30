<?php

namespace Database\Seeders;

use App\Models\StudentSkill;
use Illuminate\Database\Seeder;

class StudentSkillSeeder extends Seeder
{
    public function run(): void
    {
        StudentSkill::factory()->count(10)->create();
    }
}
