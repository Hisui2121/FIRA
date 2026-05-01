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
        $products = Product::with(['category', 'supplier', 'variants'])->get();

        $totalProducts = Product::count();
        $totalSuppliers = Supplier::count();
        $totalCategories = Category::count();
        $lowStockCount = ProductVariant::where('stock', '<', 10)->count();
    
        // 🟦 BAR CHART: STOCK BY CATEGORY
        $stockByCategory = Category::with('products.variants')->get();
    
        $stockLabels = [];
        $stockData = [];
    
        foreach ($stockByCategory as $category) {
            $totalStock = 0;
    
            foreach ($category->products as $product) {
                foreach ($product->variants as $variant) {
                    $totalStock += $variant->stock;
                }
            }
    
            $stockLabels[] = $category->name;
            $stockData[] = $totalStock;
        }
    
        // 🟩 DONUT CHART: CATEGORY COUNT
        $categoryLabels = Category::pluck('name');
        $categoryData = Category::withCount('products')->pluck('products_count');
    
        return view('admin.dashboard', compact(
            'products',
            'totalProducts',
            'totalSuppliers',
            'totalCategories',
            'lowStockCount',
            'stockLabels',
            'stockData',
            'categoryLabels',
            'categoryData'
        ));
    }
}