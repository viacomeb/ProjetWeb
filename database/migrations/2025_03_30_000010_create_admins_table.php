<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Admins', function (Blueprint $table) {
            $table->id('admin_id');
            $table->foreignId('user_id')->unique()->constrained('Users', 'user_id')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Admins');
    }
};
