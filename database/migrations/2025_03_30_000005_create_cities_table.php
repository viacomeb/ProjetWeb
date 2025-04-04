<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Cities', function (Blueprint $table) {
            $table->id('city_id');
            $table->string('city_name', 50);
            $table->integer('postal_code');
            $table->foreignId('department_id')->constrained('Departments', 'department_id')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Cities');
    }
};
