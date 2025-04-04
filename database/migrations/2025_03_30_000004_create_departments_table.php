<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Departments', function (Blueprint $table) {
            $table->id('department_id');
            $table->string('department_name', 50);
            $table->foreignId('country_id')->constrained('Countries', 'country_id')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Departments');
    }
};
