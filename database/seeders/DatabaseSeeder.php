<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\CountrySeeder;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\CitySeeder;
use Database\Seeders\CompanySeeder;
use Database\Seeders\SkillSeeder;
use Database\Seeders\StatusSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\StudentSeeder;
use Database\Seeders\OfferSeeder;
use Database\Seeders\RatingSeeder;
use Database\Seeders\PilotSeeder;
use Database\Seeders\InterviewSeeder;
use Database\Seeders\ApplicationSeeder;
use Database\Seeders\AdminSeeder;


class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            /* CountrySeeder::class,
            DepartmentSeeder::class,
            CitySeeder::class,
            CompanySeeder::class,
            SkillSeeder::class,
            StatusSeeder::class, */
            UserSeeder::class,
            StudentSeeder::class,
            OfferSeeder::class,
            RatingSeeder::class,
            PilotSeeder::class,
            InterviewSeeder::class,
            ApplicationSeeder::class,
            AdminSeeder::class,
        ]);
    }
}
