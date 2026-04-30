<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Category;
use App\Models\Supplier;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalSuppliers = Supplier::count();
        $totalCategories = Category::count();
        $lowStockCount = ProductVariant::where('stock', '<', 10)->count();

        $stockByCategory = Category::select('categories.name')
        ->join('products', 'products.category_id', '=', 'categories.id')
        ->join('product_variants', 'product_variants.product_id', '=', 'products.id')
        ->selectRaw('SUM(product_variants.stock) as total_stock')
        ->groupBy('categories.name')
        ->get();

        $categorySplit = Category::withCount('products')->get();

        $categoryLabels = $categorySplit->pluck('name');
        $categoryData = $categorySplit->pluck('products_count');

        $stockLabels = $stockByCategory->pluck('name');
        $stockData = $stockByCategory->pluck('total_stock');

        return view('dashboard', [
            'totalProducts' => $totalProducts,
            'totalSuppliers' => $totalSuppliers,
            'totalCategories' => $totalCategories,
            'lowStockCount' => $lowStockCount,
        
            // ✅ REQUIRED
            'stockLabels' => $stockLabels,
            'stockData' => $stockData,
        
            'categoryLabels' => $categoryLabels,
            'categoryData' => $categoryData,
        ]);
    }
}