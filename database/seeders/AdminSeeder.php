<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@fira.com'],
            [
                'first_name'   => 'Jade',
                'last_name'    => 'Admin',
                'password'     => Hash::make('Admin2024!'),
                'birthdate'    => '1990-06-15',
                'sex'          => 'Male',
                'phone_number' => '09171000001',
                'city'         => 'Makati City',
                'barangay'     => 'Bel-Air',
                'street'       => 'Ayala Avenue',
                'house_no'     => '88',
            ]
        );

        $admin->assignRole('admin');
    }
}
