<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Applications', function (Blueprint $table) {
            $table->id('application_id');
            $table->string('cover_letter_path', 255)->nullable();
            $table->date('application_date');
            $table->foreignId('offer_id')->constrained('Offers', 'offer_id')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('Students', 'student_id')->cascadeOnDelete();
            $table->foreignId('status_id')->constrained('Status', 'status_id')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Applications');
    }
};
