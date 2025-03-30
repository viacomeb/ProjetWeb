<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Skills', function (Blueprint $table) {
            $table->id('skill_id');
            $table->string('name', 50);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Skills');
    }
};
