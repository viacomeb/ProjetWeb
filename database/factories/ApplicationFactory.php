<?php

namespace Database\Factories;

use App\Models\Application;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    protected $model = Application::class;

    public function definition(): array
    {
        return [
            'cover_letter_path' => $this->faker->filePath(),
            'application_date' => $this->faker->date(),
            'offer_id' => \App\Models\Offer::factory(),
            'student_id' => \App\Models\Student::factory(),
            'status_id' => \App\Models\Status::factory(),
        ];
    }
}
