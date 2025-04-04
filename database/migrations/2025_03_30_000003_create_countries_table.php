<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Countries', function (Blueprint $table) {
            $table->id('country_id');
            $table->string('country_name', 50);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Countries');
    }
};
