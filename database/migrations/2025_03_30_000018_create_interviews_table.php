<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Interviews', function (Blueprint $table) {
            $table->foreignId('offer_id')->constrained('Offers', 'offer_id')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('Students', 'student_id')->cascadeOnDelete();
            $table->dateTime('interview_date');
            $table->primary(['offer_id', 'student_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Interviews');
    }
};
