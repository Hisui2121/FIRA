<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'stephenjadec@gmail.com'],
            [
                'name' => 'Jade',
                'password' => Hash::make('Jade2021'),
            ]
        );
    
        $admin->assignRole('admin');
    }
}
