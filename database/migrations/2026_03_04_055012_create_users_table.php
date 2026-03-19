<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->date('birthdate')->nullable();
            $table->enum('sex', ['Male', 'Female'])->nullable();
            $table->string('phone_number')->nullable();
            $table->string('city')->nullable();
            $table->string('barangay')->nullable();
            $table->string('street')->nullable();
            $table->string('house_no')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};