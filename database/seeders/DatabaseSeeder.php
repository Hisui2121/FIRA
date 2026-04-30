<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductVariant;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            CategorySeeder::class,
            SupplierSeeder::class,
        ]);

        // // User::factory(10)->create();
        // $product = Product::create([
        //     'name' => 'T-Shirt',
        //     'base_price' => 300
        // ]);
      
        // ProductVariant::create([
        //     'product_id' => $product->id,
        //     'size' => 'S',
        //     'color' => 'Black',
        //     'stock' => 10,
        //     'price_override' => null
        // ]);

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
