<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('StudentSkills', function (Blueprint $table) {
            $table->foreignId('skill_id')->constrained('Skills', 'skill_id')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('Students', 'student_id')->cascadeOnDelete();
            $table->primary(['skill_id', 'student_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('StudentSkills');
    }
};
