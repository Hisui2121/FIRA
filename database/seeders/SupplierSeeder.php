<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'UniStyle Apparel Co.',
                'contact_person' => 'Maria Santos',
                'phone' => '09171234567',
                'email' => 'contact@unistyle.com',
                'address' => 'Manila, Philippines'
            ],
            [
                'name' => 'Metro Fashion Supplies',
                'contact_person' => 'John Reyes',
                'phone' => '09181234567',
                'email' => 'sales@metrofashion.com',
                'address' => 'Quezon City, Philippines'
            ],
            [
                'name' => 'TrendWear Manufacturing',
                'contact_person' => 'Anna Cruz',
                'phone' => '09271234567',
                'email' => 'info@trendwear.com',
                'address' => 'Cebu City, Philippines'
            ],
            [
                'name' => 'StyleHub Trading Inc.',
                'contact_person' => 'Michael Tan',
                'phone' => '09391234567',
                'email' => 'support@stylehub.com',
                'address' => 'Davao City, Philippines'
            ],
            [
                'name' => 'FashionLink Global',
                'contact_person' => 'Sarah Lim',
                'phone' => '09451234567',
                'email' => 'hello@fashionlink.com',
                'address' => 'Makati City, Philippines'
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}