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
                // Pinalitan natin ang 'name' para sumunod sa database columns mo
                'first_name' => 'Jade',
                'last_name' => 'Admin',
                'password' => Hash::make('Jade2021'),
                
                // Nilagyan natin ng dummy data ang iba pang required fields
                'birthdate' => '2000-01-01',
                'sex' => 'Male',
                'phone_number' => '09123456789',
                'city' => 'Taguig City',
                'barangay' => 'New Lower Bicutan',
                'street' => 'M.L Quezon Street',
                'house_no' => '1',
            ]
        );
    
        $admin->assignRole('admin');
    }
}