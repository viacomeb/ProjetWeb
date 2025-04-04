<?php

namespace Database\Factories;

use App\Models\Entreprise;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntrepriseFactory extends Factory
{
    /**
     * Le modèle correspondant à cette factory.
     *
     * @var string
     */
    protected $model = Entreprise::class;

    /**
     * Définir le modèle de données par défaut.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->company, // Nom de l'entreprise
            'description' => $this->faker->paragraph, // Description de l'entreprise
            'telephone' => $this->faker->phoneNumber, // Numéro de téléphone
            'candidatures' => $this->faker->numberBetween(0, 100), // Nombre de candidatures
            'email' => $this->faker->companyEmail, // Email de l'entreprise
        ];
    }
}
