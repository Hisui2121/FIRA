<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        $staffMembers = [
            [
                'first_name'   => 'Maria',
                'last_name'    => 'Santos',
                'email'        => 'maria.santos@fira.com',
                'password'     => Hash::make('Staff2024!'),
                'birthdate'    => '1995-03-22',
                'sex'          => 'Female',
                'phone_number' => '09181000001',
                'city'         => 'Quezon City',
                'barangay'     => 'Commonwealth',
                'street'       => 'Batangas Street',
                'house_no'     => '12',
            ],
            [
                'first_name'   => 'Juan',
                'last_name'    => 'Reyes',
                'email'        => 'juan.reyes@fira.com',
                'password'     => Hash::make('Staff2024!'),
                'birthdate'    => '1998-11-10',
                'sex'          => 'Male',
                'phone_number' => '09271000002',
                'city'         => 'Pasig City',
                'barangay'     => 'Kapitolyo',
                'street'       => 'Meralco Avenue',
                'house_no'     => '45',
            ],
            [
                'first_name'   => 'Anna',
                'last_name'    => 'Cruz',
                'email'        => 'anna.cruz@fira.com',
                'password'     => Hash::make('Staff2024!'),
                'birthdate'    => '1997-07-08',
                'sex'          => 'Female',
                'phone_number' => '09391000003',
                'city'         => 'Marikina City',
                'barangay'     => 'Concepcion',
                'street'       => 'Sumulong Highway',
                'house_no'     => '77',
            ],
            [
                'first_name'   => 'Carlo',
                'last_name'    => 'Tan',
                'email'        => 'carlo.tan@fira.com',
                'password'     => Hash::make('Staff2024!'),
                'birthdate'    => '1996-01-30',
                'sex'          => 'Male',
                'phone_number' => '09451000004',
                'city'         => 'Manila',
                'barangay'     => 'Ermita',
                'street'       => 'Taft Avenue',
                'house_no'     => '200',
            ],
            [
                'first_name'   => 'Lea',
                'last_name'    => 'Dela Cruz',
                'email'        => 'lea.delacruz@fira.com',
                'password'     => Hash::make('Staff2024!'),
                'birthdate'    => '1999-09-14',
                'sex'          => 'Female',
                'phone_number' => '09561000005',
                'city'         => 'Caloocan City',
                'barangay'     => 'Deparo',
                'street'       => 'Gen. Luis Street',
                'house_no'     => '33',
            ],
        ];

        foreach ($staffMembers as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                $data
            );

            $user->assignRole('staff');
        }
    }
}
