<?php

namespace Database\Factories;

use App\Models\Wishlist;
use App\Models\Offer;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class WishlistFactory extends Factory
{
    protected $model = Wishlist::class;

    public function definition(): array
    {
        return [
            'offer_id' => Offer::factory(),
            'student_id' => Student::factory(),
        ];
    }
}
