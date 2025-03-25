<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('entreprises')) {
            Schema::create('entreprises', function (Blueprint $table) {
                $table->id('Id_Entreprise');  // Identifiant unique de l'entreprise (clé primaire)
                $table->string('nom');  // Nom de l'entreprise
                $table->text('description');  // Description de l'entreprise
                $table->string('telephone');  // Numéro de téléphone de l'entreprise
                $table->integer('candidatures')->default(0);  // Nombre de candidatures reçues, initialisé à 0
                $table->string('email')->unique();  // Adresse e-mail de l'entreprise, unique dans la table

                $table->timestamps();  // Champs created_at et updated_at
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entreprises');
    }
};
