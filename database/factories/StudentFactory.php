<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        return [
            'xp_points' => $this->faker->numberBetween(0, 1000),
            'cv_path' => $this->faker->filePath(),
            'status_id' => \App\Models\Status::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
