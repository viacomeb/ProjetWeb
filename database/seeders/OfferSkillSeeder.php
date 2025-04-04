<?php

namespace Database\Seeders;

use App\Models\OfferSkill;
use Illuminate\Database\Seeder;

class OfferSkillSeeder extends Seeder
{
    public function run(): void
    {
        OfferSkill::factory()->count(10)->create();
    }
}
