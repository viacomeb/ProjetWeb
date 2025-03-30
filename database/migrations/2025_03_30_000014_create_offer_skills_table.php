<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('OfferSkills', function (Blueprint $table) {
            $table->foreignId('offer_id')->constrained('Offers', 'offer_id')->cascadeOnDelete();
            $table->foreignId('skill_id')->constrained('Skills', 'skill_id')->cascadeOnDelete();
            $table->primary(['offer_id', 'skill_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('OfferSkills');
    }
};
