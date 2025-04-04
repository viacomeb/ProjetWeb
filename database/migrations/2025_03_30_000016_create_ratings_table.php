<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Ratings', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('Users', 'user_id')->cascadeOnDelete();
            $table->foreignId('company_id')->constrained('Companies', 'company_id')->cascadeOnDelete();
            $table->string('rating', 50);
            $table->primary(['user_id', 'company_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Ratings');
    }
};
