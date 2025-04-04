<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Status', function (Blueprint $table) {
            $table->id('status_id');
            $table->string('status_name', 50);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Status');
    }
};
