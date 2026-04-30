<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        
        $categories = [
            'T-Shirts',
            'Pants',
            'Shoes',
            'Hats',
            'Accessories',
            'Jackets',
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat
            ]);
        }
    }
    
}