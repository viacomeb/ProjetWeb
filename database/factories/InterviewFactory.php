<?php

namespace Database\Factories;

use App\Models\Interview;
use Illuminate\Database\Eloquent\Factories\Factory;

class InterviewFactory extends Factory
{
    protected $model = Interview::class;

    public function definition(): array
    {
        return [
            'offer_id' => \App\Models\Offer::factory(),
            'student_id' => \App\Models\Student::factory(),
            'interview_date' => $this->faker->dateTime(),
        ];
    }
}
