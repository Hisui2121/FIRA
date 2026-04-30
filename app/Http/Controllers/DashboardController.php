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

        return view('dashboard', compact(
            'totalProducts',
            'totalSuppliers',
            'totalCategories',
            'lowStockCount'
        ));
    }
}