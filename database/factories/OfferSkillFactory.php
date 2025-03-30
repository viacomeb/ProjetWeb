<?php

namespace Database\Factories;

use App\Models\OfferSkill;
use App\Models\Offer;
use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

class OfferSkillFactory extends Factory
{
    protected $model = OfferSkill::class;

    public function definition(): array
    {
        return [
            'offer_id' => Offer::factory(),
            'skill_id' => Skill::factory(),
        ];
    }
}
