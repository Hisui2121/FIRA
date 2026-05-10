<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Category;
use App\Models\Supplier;

class ReportController extends Controller
{
    public function index()
    {
        // ── Total Counts (matches ProductController logic) ──
        $totalProducts   = Product::count();
        $totalSuppliers  = Supplier::count();
        $totalCategories = Category::count();

        // ── Low Stock — uses ProductVariant.stock < 10 (same as ProductController) ──
        $lowStockThreshold = 10;
        $lowStockCount     = ProductVariant::where('stock', '<', $lowStockThreshold)->count();

        // Low stock products with their variants
        $lowStockProducts = Product::with(['category', 'variants'])
            ->whereHas('variants', function ($q) use ($lowStockThreshold) {
                $q->where('stock', '<', $lowStockThreshold);
            })
            ->take(8)
            ->get();

        // ── Stock by Category (sum of all variant stocks per category) ──
        $stockByCategory = Category::with(['products.variants'])
            ->get()
            ->map(function ($cat) {
                return (object)[
                    'name'           => $cat->name,
                    'total_quantity' => $cat->products->sum(function ($product) {
                        return $product->variants->sum('stock');
                    }),
                ];
            })
            ->filter(fn($c) => $c->total_quantity > 0)
            ->sortByDesc('total_quantity')
            ->values();

        // ── Top 5 Products by total variant stock ──
        $topProducts = Product::with(['category', 'variants'])
            ->get()
            ->map(function ($product) {
                $product->total_quantity = $product->variants->sum('stock');
                return $product;
            })
            ->sortByDesc('total_quantity')
            ->take(5)
            ->values();

        return view('reports', compact(
            'totalProducts',
            'totalSuppliers',
            'totalCategories',
            'lowStockProducts',
            'lowStockCount',
            'stockByCategory',
            'topProducts'
        ));
    }
}