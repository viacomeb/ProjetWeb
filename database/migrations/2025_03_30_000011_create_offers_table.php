<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Offers', function (Blueprint $table) {
            $table->id('offer_id');
            $table->string('title', 50);
            $table->text('description')->nullable();
            $table->decimal('salary', 10, 2)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('view_count')->default(0);
            $table->foreignId('company_id')->constrained('Companies', 'company_id')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Offers');
    }
};
