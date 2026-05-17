<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Category;
use App\Models\Supplier;

class ReportsController extends Controller
{
    public function index()
    {
        $totalProducts   = Product::count();
        $totalSuppliers  = Supplier::count();
        $totalCategories = Category::count();
        $totalVariants   = 0;
        $totalStockValue = 0;
        $lowStockCount   = 0;

        $stockLabels  = [];
        $stockData    = [];
        $healthyStock = [];
        $lowStockData = [];
        $categoryLabels = collect();
        $categoryData   = collect();
        $lowStockItems  = collect();
        $topProducts    = collect();

        try {
            $lowStockCount   = ProductVariant::where('stock', '<', 10)->count();
            $totalVariants   = ProductVariant::count();

            // Total stock value = sum of (price * stock) per variant
            $totalStockValue = ProductVariant::join('products', 'product_variants.product_id', '=', 'products.id')
                ->selectRaw('SUM(products.price * product_variants.stock) as total')
                ->value('total') ?? 0;

            // Stock by Category
            $categories = Category::all();
            foreach ($categories as $category) {
                $total = ProductVariant::whereHas('product', function ($q) use ($category) {
                    $q->where('category_id', $category->id);
                })->sum('stock');

                $low = ProductVariant::whereHas('product', function ($q) use ($category) {
                    $q->where('category_id', $category->id);
                })->where('stock', '<', 10)->sum('stock');

                $stockLabels[]  = $category->name;
                $stockData[]    = $total;
                $lowStockData[] = $low;
                $healthyStock[] = max(0, $total - $low);
            }

            // Category split
            $categoryLabels = $categories->pluck('name');
            $categoryData   = $categories->map(function ($cat) {
                return Product::where('category_id', $cat->id)->count();
            });

            // Low stock items
            $lowStockItems = ProductVariant::with('product')
                ->where('stock', '<', 10)
                ->orderBy('stock', 'asc')
                ->get();

            // Top products
            $topProducts = ProductVariant::with('product')
                ->orderBy('stock', 'desc')
                ->take(5)
                ->get();

        } catch (\Exception $e) {
            // Tables not ready yet
        }

        return view('reports.index', compact(
            'totalProducts',
            'totalSuppliers',
            'totalCategories',
            'totalVariants',
            'totalStockValue',
            'lowStockCount',
            'stockLabels',
            'stockData',
            'healthyStock',
            'lowStockData',
            'categoryLabels',
            'categoryData',
            'lowStockItems',
            'topProducts'
        ));
    }
}