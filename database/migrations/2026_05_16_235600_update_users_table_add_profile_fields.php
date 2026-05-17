<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

public function up(): void
{
    Schema::table('users', function (Blueprint $table) {

        if (!Schema::hasColumn('users', 'first_name')) {
            $table->string('first_name')->after('id');
        }

        if (!Schema::hasColumn('users', 'last_name')) {
            $table->string('last_name')->nullable();
        }

        if (!Schema::hasColumn('users', 'birthdate')) {
            $table->date('birthdate')->nullable();
        }

        if (!Schema::hasColumn('users', 'sex')) {
            $table->enum('sex', ['Male', 'Female'])->nullable();
        }

        if (!Schema::hasColumn('users', 'phone_number')) {
            $table->string('phone_number')->nullable();
        }

        if (!Schema::hasColumn('users', 'city')) {
            $table->string('city')->nullable();
        }

        if (!Schema::hasColumn('users', 'barangay')) {
            $table->string('barangay')->nullable();
        }

        if (!Schema::hasColumn('users', 'street')) {
            $table->string('street')->nullable();
        }

        if (!Schema::hasColumn('users', 'house_no')) {
            $table->string('house_no')->nullable();
        }
    });
}

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // Restore old name
            $table->string('name');

            // Remove added fields
            $table->dropColumn([
                'first_name',
                'last_name',
                'birthdate',
                'sex',
                'phone_number',
                'city',
                'barangay',
                'street',
                'house_no',
                'email_verified_at',
                'remember_token'
            ]);
        });
    }
};