<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Category;
use App\Models\Supplier;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Fetch category and supplier IDs by name
        $cats = Category::pluck('id', 'name');
        $sups = Supplier::pluck('id', 'name');

        $products = [
            // ── T-Shirts ──────────────────────────────────────────────
            [
                'name'        => 'Essential Crew Tee',
                'sku'         => 'TSH-001',
                'price'       => 299.00,
                'category'    => 'T-Shirts',
                'supplier'    => 'UniStyle Apparel Co.',
                'variants'    => [
                    ['size' => 'S',  'color' => 'White',  'stock' => 30],
                    ['size' => 'M',  'color' => 'White',  'stock' => 25],
                    ['size' => 'L',  'color' => 'White',  'stock' => 20],
                    ['size' => 'S',  'color' => 'Black',  'stock' => 35],
                    ['size' => 'M',  'color' => 'Black',  'stock' => 28],
                    ['size' => 'L',  'color' => 'Black',  'stock' => 22],
                    ['size' => 'XL', 'color' => 'Black',  'stock' => 10],
                ],
            ],
            [
                'name'        => 'Graphic Print Oversized Tee',
                'sku'         => 'TSH-002',
                'price'       => 450.00,
                'category'    => 'T-Shirts',
                'supplier'    => 'Metro Fashion Supplies',
                'variants'    => [
                    ['size' => 'S',  'color' => 'Gray',   'stock' => 15],
                    ['size' => 'M',  'color' => 'Gray',   'stock' => 18],
                    ['size' => 'L',  'color' => 'Gray',   'stock' => 12],
                    ['size' => 'M',  'color' => 'Navy',   'stock' => 20],
                    ['size' => 'L',  'color' => 'Navy',   'stock' => 14],
                    ['size' => 'XL', 'color' => 'Navy',   'stock' => 5],
                ],
            ],
            [
                'name'        => 'Polo Collar Tee',
                'sku'         => 'TSH-003',
                'price'       => 380.00,
                'category'    => 'T-Shirts',
                'supplier'    => 'TrendWear Manufacturing',
                'variants'    => [
                    ['size' => 'S',  'color' => 'White',  'stock' => 8],
                    ['size' => 'M',  'color' => 'White',  'stock' => 12],
                    ['size' => 'L',  'color' => 'Blue',   'stock' => 9],
                    ['size' => 'XL', 'color' => 'Blue',   'stock' => 3],
                ],
            ],

            // ── Pants ─────────────────────────────────────────────────
            [
                'name'        => 'Slim Fit Chinos',
                'sku'         => 'PNT-001',
                'price'       => 799.00,
                'category'    => 'Pants',
                'supplier'    => 'StyleHub Trading Inc.',
                'variants'    => [
                    ['size' => '28', 'color' => 'Khaki',  'stock' => 20],
                    ['size' => '30', 'color' => 'Khaki',  'stock' => 25],
                    ['size' => '32', 'color' => 'Khaki',  'stock' => 18],
                    ['size' => '34', 'color' => 'Khaki',  'stock' => 10],
                    ['size' => '30', 'color' => 'Navy',   'stock' => 22],
                    ['size' => '32', 'color' => 'Navy',   'stock' => 16],
                ],
            ],
            [
                'name'        => 'Relaxed Jogger Pants',
                'sku'         => 'PNT-002',
                'price'       => 650.00,
                'category'    => 'Pants',
                'supplier'    => 'UniStyle Apparel Co.',
                'variants'    => [
                    ['size' => 'S',  'color' => 'Black',  'stock' => 30],
                    ['size' => 'M',  'color' => 'Black',  'stock' => 24],
                    ['size' => 'L',  'color' => 'Black',  'stock' => 18],
                    ['size' => 'S',  'color' => 'Gray',   'stock' => 12],
                    ['size' => 'M',  'color' => 'Gray',   'stock' => 7],
                ],
            ],
            [
                'name'        => 'Straight Cut Jeans',
                'sku'         => 'PNT-003',
                'price'       => 999.00,
                'category'    => 'Pants',
                'supplier'    => 'FashionLink Global',
                'variants'    => [
                    ['size' => '28', 'color' => 'Indigo', 'stock' => 14],
                    ['size' => '30', 'color' => 'Indigo', 'stock' => 20],
                    ['size' => '32', 'color' => 'Indigo', 'stock' => 15],
                    ['size' => '34', 'color' => 'Indigo', 'stock' => 6],
                    ['size' => '30', 'color' => 'Black',  'stock' => 18],
                    ['size' => '32', 'color' => 'Black',  'stock' => 11],
                ],
            ],

            // ── Shoes ─────────────────────────────────────────────────
            [
                'name'        => 'Low-Top Canvas Sneakers',
                'sku'         => 'SHO-001',
                'price'       => 1299.00,
                'category'    => 'Shoes',
                'supplier'    => 'Metro Fashion Supplies',
                'variants'    => [
                    ['size' => '40', 'color' => 'White',  'stock' => 10],
                    ['size' => '41', 'color' => 'White',  'stock' => 14],
                    ['size' => '42', 'color' => 'White',  'stock' => 12],
                    ['size' => '43', 'color' => 'White',  'stock' => 8],
                    ['size' => '41', 'color' => 'Black',  'stock' => 16],
                    ['size' => '42', 'color' => 'Black',  'stock' => 9],
                    ['size' => '43', 'color' => 'Black',  'stock' => 5],
                ],
            ],
            [
                'name'        => 'Slip-On Loafers',
                'sku'         => 'SHO-002',
                'price'       => 1099.00,
                'category'    => 'Shoes',
                'supplier'    => 'TrendWear Manufacturing',
                'variants'    => [
                    ['size' => '40', 'color' => 'Brown',  'stock' => 7],
                    ['size' => '41', 'color' => 'Brown',  'stock' => 9],
                    ['size' => '42', 'color' => 'Brown',  'stock' => 6],
                    ['size' => '41', 'color' => 'Black',  'stock' => 11],
                    ['size' => '42', 'color' => 'Black',  'stock' => 8],
                    ['size' => '43', 'color' => 'Black',  'stock' => 4],
                ],
            ],

            // ── Hats ──────────────────────────────────────────────────
            [
                'name'        => 'Classic Baseball Cap',
                'sku'         => 'HAT-001',
                'price'       => 299.00,
                'category'    => 'Hats',
                'supplier'    => 'StyleHub Trading Inc.',
                'variants'    => [
                    ['size' => 'One Size', 'color' => 'Black',  'stock' => 40],
                    ['size' => 'One Size', 'color' => 'White',  'stock' => 32],
                    ['size' => 'One Size', 'color' => 'Navy',   'stock' => 25],
                    ['size' => 'One Size', 'color' => 'Red',    'stock' => 15],
                ],
            ],
            [
                'name'        => 'Bucket Hat',
                'sku'         => 'HAT-002',
                'price'       => 349.00,
                'category'    => 'Hats',
                'supplier'    => 'FashionLink Global',
                'variants'    => [
                    ['size' => 'S/M', 'color' => 'Beige',  'stock' => 20],
                    ['size' => 'L/XL','color' => 'Beige',  'stock' => 18],
                    ['size' => 'S/M', 'color' => 'Black',  'stock' => 22],
                    ['size' => 'L/XL','color' => 'Black',  'stock' => 14],
                ],
            ],

            // ── Accessories ───────────────────────────────────────────
            [
                'name'        => 'Canvas Tote Bag',
                'sku'         => 'ACC-001',
                'price'       => 249.00,
                'category'    => 'Accessories',
                'supplier'    => 'UniStyle Apparel Co.',
                'variants'    => [
                    ['size' => 'Standard', 'color' => 'Natural', 'stock' => 50],
                    ['size' => 'Standard', 'color' => 'Black',   'stock' => 35],
                    ['size' => 'Large',    'color' => 'Natural', 'stock' => 28],
                    ['size' => 'Large',    'color' => 'Black',   'stock' => 20],
                ],
            ],
            [
                'name'        => 'Leather Belt',
                'sku'         => 'ACC-002',
                'price'       => 499.00,
                'category'    => 'Accessories',
                'supplier'    => 'Metro Fashion Supplies',
                'variants'    => [
                    ['size' => '30', 'color' => 'Black',  'stock' => 20],
                    ['size' => '32', 'color' => 'Black',  'stock' => 22],
                    ['size' => '34', 'color' => 'Black',  'stock' => 15],
                    ['size' => '30', 'color' => 'Brown',  'stock' => 18],
                    ['size' => '32', 'color' => 'Brown',  'stock' => 16],
                    ['size' => '34', 'color' => 'Brown',  'stock' => 8],
                ],
            ],
            [
                'name'        => 'Knit Scarf',
                'sku'         => 'ACC-003',
                'price'       => 199.00,
                'category'    => 'Accessories',
                'supplier'    => 'TrendWear Manufacturing',
                'variants'    => [
                    ['size' => 'One Size', 'color' => 'Gray',   'stock' => 3],
                    ['size' => 'One Size', 'color' => 'Maroon', 'stock' => 2],
                    ['size' => 'One Size', 'color' => 'Navy',   'stock' => 0],
                ],
            ],

            // ── Jackets ───────────────────────────────────────────────
            [
                'name'        => 'Lightweight Windbreaker',
                'sku'         => 'JKT-001',
                'price'       => 1599.00,
                'category'    => 'Jackets',
                'supplier'    => 'StyleHub Trading Inc.',
                'variants'    => [
                    ['size' => 'S',  'color' => 'Olive',  'stock' => 12],
                    ['size' => 'M',  'color' => 'Olive',  'stock' => 15],
                    ['size' => 'L',  'color' => 'Olive',  'stock' => 10],
                    ['size' => 'XL', 'color' => 'Olive',  'stock' => 6],
                    ['size' => 'S',  'color' => 'Black',  'stock' => 14],
                    ['size' => 'M',  'color' => 'Black',  'stock' => 18],
                    ['size' => 'L',  'color' => 'Black',  'stock' => 9],
                ],
            ],
            [
                'name'        => 'Denim Jacket',
                'sku'         => 'JKT-002',
                'price'       => 1899.00,
                'category'    => 'Jackets',
                'supplier'    => 'FashionLink Global',
                'variants'    => [
                    ['size' => 'S',  'color' => 'Light Blue', 'stock' => 8],
                    ['size' => 'M',  'color' => 'Light Blue', 'stock' => 12],
                    ['size' => 'L',  'color' => 'Light Blue', 'stock' => 7],
                    ['size' => 'XL', 'color' => 'Light Blue', 'stock' => 4],
                    ['size' => 'M',  'color' => 'Dark Blue',  'stock' => 9],
                    ['size' => 'L',  'color' => 'Dark Blue',  'stock' => 5],
                ],
            ],
            [
                'name'        => 'Fleece Zip-Up Hoodie',
                'sku'         => 'JKT-003',
                'price'       => 1199.00,
                'category'    => 'Jackets',
                'supplier'    => 'UniStyle Apparel Co.',
                'variants'    => [
                    ['size' => 'S',  'color' => 'Charcoal', 'stock' => 16],
                    ['size' => 'M',  'color' => 'Charcoal', 'stock' => 20],
                    ['size' => 'L',  'color' => 'Charcoal', 'stock' => 14],
                    ['size' => 'XL', 'color' => 'Charcoal', 'stock' => 8],
                    ['size' => 'M',  'color' => 'Cream',    'stock' => 11],
                    ['size' => 'L',  'color' => 'Cream',    'stock' => 7],
                ],
            ],
        ];

        $skuCounter = 1;

        foreach ($products as $data) {
            $product = Product::create([
                'name'        => $data['name'],
                'sku'         => $data['sku'],
                'price'       => $data['price'],
                'category_id' => $cats[$data['category']],
                'supplier_id' => $sups[$data['supplier']],
            ]);

            foreach ($data['variants'] as $variant) {
                ProductVariant::create([
                    'product_id'     => $product->id,
                    'sku'            => $data['sku'] . '-' . str_pad($skuCounter++, 3, '0', STR_PAD_LEFT),
                    'size'           => $variant['size'],
                    'color'          => $variant['color'],
                    'stock'          => $variant['stock'],
                    'price_override' => null,
                ]);
            }
        }
    }
}
