<?php
namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Category;
use App\Models\Supplier;

class StaffDashboardController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'supplier', 'variants'])->get();

        $totalProducts = Product::count();
        $totalSuppliers = Supplier::count();
        $totalCategories = Category::count();
        $lowStockCount = ProductVariant::where('stock', '<', 10)->count();

        $categories = Category::all();

        // SAME CHART DATA AS ADMIN
        $stockLabels = $categories->pluck('name');

        $stockData = $categories->map(function ($category) {
            return ProductVariant::whereHas('product', function ($q) use ($category) {
                $q->where('category_id', $category->id);
            })->sum('stock');
        });

        $categoryLabels = $stockLabels;
        $categoryData = $stockData;

        return view('staff.dashboard', compact(
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