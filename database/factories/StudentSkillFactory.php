<?php

namespace Database\Factories;

use App\Models\StudentSkill;
use App\Models\Student;
use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentSkillFactory extends Factory
{
    protected $model = StudentSkill::class;

    public function definition(): array
    {
        return [
            'skill_id' => Skill::factory(),
            'student_id' => Student::factory(),
        ];
    }
}
