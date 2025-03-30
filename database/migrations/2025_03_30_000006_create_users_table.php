<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('password', 255);
            $table->string('last_name', 50)->nullable();
            $table->string('first_name', 50)->nullable();
            $table->string('email', 50)->unique();
            $table->string('street', 50)->nullable();
            $table->integer('street_number')->nullable();
            $table->foreignId('city_id')->constrained('Cities', 'city_id')->cascadeOnDelete();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
