<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\AuditLog;

class AdminDashboardController extends Controller
{
    public function index()
{
    $products = Product::with(['category', 'supplier', 'variants'])->get();

    $totalProducts = Product::count();
    $totalSuppliers = Supplier::count();
    $totalCategories = Category::count();
    $lowStockCount = ProductVariant::where('stock', '<', 10)->count();

    $categories = Category::all();
    // ✅ STOCK PER CATEGORY (FIXED)
    $stockLabels = $categories->pluck('name');

    $stockData = $categories->map(function ($category) {
        return ProductVariant::whereHas('product', function ($q) use ($category) {
            $q->where('category_id', $category->id);
        })->sum('stock');
    });

    // OPTIONAL: SAME DATA FOR DONUT
    $categoryLabels = $stockLabels;
    $categoryData = $stockData;

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

    public function logs()  
    {
        $logs = AuditLog::latest()->with('user')->get();

        return view('admin.logs', compact('logs'));
    }
}