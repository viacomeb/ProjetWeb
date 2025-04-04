<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    protected $model = City::class;

    public function definition(): array
    {
        return [
            'city_name' => $this->faker->city(),
            'postal_code' => $this->faker->postcode(),
            'department_id' => Department::factory(),
        ];
    }
}
