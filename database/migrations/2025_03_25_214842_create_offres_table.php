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
        if (!Schema::hasTable('offres')) {
            Schema::create('offres', function (Blueprint $table) {
                $table->id('Id_Offre');  // Identifiant unique de l'offre (clé primaire)
                $table->string('titre');  // Titre de l'offre
                $table->text('description');  // Description de l'offre
                $table->text('competence');  // Compétences requises pour le stage
                $table->decimal('remuneration', 10, 2)->nullable();  // Rémunération, nullable s'il n'y en a pas
                $table->integer('concurrents')->default(0);  // Compteurs d'étudiants ayant postulé, initialisé à 0
                $table->date('dates');  // Date limite de l'offre ou début de la mission
                $table->foreignId('Id_Entreprise')->constrained('entreprises')->onDelete('cascade');  // Clé étrangère vers la table des entreprises, en supprimant les offres si l'entreprise est supprimée

                $table->timestamps();  // Champs created_at et updated_at
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offres');
    }
};
