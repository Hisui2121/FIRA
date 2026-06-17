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

            // Name fields (split into first/last)
            $table->string('first_name');
            $table->string('last_name')->nullable();

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            // Personal info
            $table->date('birthdate')->nullable();
            $table->enum('sex', ['Male', 'Female'])->nullable();
            $table->string('phone_number')->nullable();

            // Address
            $table->string('city')->nullable();
            $table->string('barangay')->nullable();
            $table->string('street')->nullable();
            $table->string('house_no')->nullable();

            // Photos
            $table->string('profile_photo')->nullable();
            $table->string('cover_photo')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
