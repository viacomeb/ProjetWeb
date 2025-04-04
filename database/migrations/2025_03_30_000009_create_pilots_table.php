<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Pilots', function (Blueprint $table) {
            $table->id('pilot_id');
            $table->foreignId('user_id')->unique()->constrained('Users', 'user_id')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Pilots');
    }
};
