<?php

namespace Database\Factories;

use App\Models\Intern;
use App\Models\Offer;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class InternFactory extends Factory
{
    protected $model = Intern::class;

    public function definition(): array
    {
        return [
            'offer_id' => Offer::factory(),
            'student_id' => Student::factory(),
        ];
    }
}
