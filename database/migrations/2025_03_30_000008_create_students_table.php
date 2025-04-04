<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Students', function (Blueprint $table) {
            $table->id('student_id');
            $table->integer('xp_points')->default(0);
            $table->string('cv_path', 255)->nullable();
            $table->foreignId('status_id')->constrained('Status', 'status_id')->cascadeOnDelete();
            $table->foreignId('user_id')->unique()->constrained('Users', 'user_id')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Students');
    }
};
