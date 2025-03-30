<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Companies', function (Blueprint $table) {
            $table->id('company_id');
            $table->string('company_name', 50);
            $table->text('description')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('street', 50)->nullable();
            $table->integer('street_number')->nullable();
            $table->foreignId('city_id')->constrained('Cities', 'city_id')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Companies');
    }
};
