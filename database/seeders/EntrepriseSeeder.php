<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Entreprise;

class EntrepriseSeeder extends Seeder
{
    /**
     * Exécuter la commande de la base de données.
     *
     * @return void
     */
    public function run()
    {
        // Générer 10 entreprises fictives
        Entreprise::factory()->count(10)->create();
    }
}
