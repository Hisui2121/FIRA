<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        // --- Filters ---
        $categoryId  = $request->input('category_id');
        $supplierId  = $request->input('supplier_id');
        $dateFrom    = $request->input('date_from');
        $dateTo      = $request->input('date_to');

        // --- Base counts (unfiltered) ---
        $totalProducts   = Product::count();
        $totalSuppliers  = Supplier::count();
        $totalCategories = Category::count();
        $totalVariants   = 0;
        $totalStockValue = 0;
        $lowStockCount   = 0;

        $stockLabels    = [];
        $stockData      = [];
        $healthyStock   = [];
        $lowStockData   = [];
        $categoryLabels = collect();
        $categoryData   = collect();
        $lowStockItems  = collect();
        $topProducts    = collect();
        $topSuppliers   = collect();
        $allProducts    = collect();

        // For filter dropdowns
        $categories = Category::orderBy('name')->get();
        $suppliers  = Supplier::orderBy('name')->get();

        try {
            // --- Filtered product query builder ---
            $productQuery = Product::query();

            if ($categoryId) {
                $productQuery->where('category_id', $categoryId);
            }
            if ($supplierId) {
                $productQuery->where('supplier_id', $supplierId);
            }
            if ($dateFrom) {
                $productQuery->whereDate('created_at', '>=', $dateFrom);
            }
            if ($dateTo) {
                $productQuery->whereDate('created_at', '<=', $dateTo);
            }

            $filteredProductIds = (clone $productQuery)->pluck('id');

            // --- Filtered variant query builder ---
            $variantQuery = ProductVariant::whereIn('product_id', $filteredProductIds);

            $lowStockCount   = (clone $variantQuery)->where('stock', '<', 10)->count();
            $totalVariants   = (clone $variantQuery)->count();

            $totalStockValue = ProductVariant::join('products', 'product_variants.product_id', '=', 'products.id')
                ->whereIn('product_variants.product_id', $filteredProductIds)
                ->selectRaw('SUM(products.price * product_variants.stock) as total')
                ->value('total') ?? 0;

            // --- Stock by Category (respects supplier + date filters) ---
            $chartCategories = $categoryId
                ? Category::where('id', $categoryId)->get()
                : Category::all();

            foreach ($chartCategories as $category) {
                $baseIds = (clone $productQuery)->where('category_id', $category->id)->pluck('id');

                $total = ProductVariant::whereIn('product_id', $baseIds)->sum('stock');
                $low   = ProductVariant::whereIn('product_id', $baseIds)->where('stock', '<', 10)->sum('stock');

                $stockLabels[]  = $category->name;
                $stockData[]    = $total;
                $lowStockData[] = $low;
                $healthyStock[] = max(0, $total - $low);
            }

            // --- Category split ---
            $categoryLabels = $chartCategories->pluck('name');
            $categoryData   = $chartCategories->map(function ($cat) use ($productQuery) {
                return (clone $productQuery)->where('category_id', $cat->id)->count();
            });

            // --- Low stock items ---
            $lowStockItems = ProductVariant::with('product.category')
                ->whereIn('product_id', $filteredProductIds)
                ->where('stock', '<', 10)
                ->orderBy('stock', 'asc')
                ->get();

            // --- Top 5 variants by stock ---
            $topProducts = ProductVariant::with('product.category')
                ->whereIn('product_id', $filteredProductIds)
                ->orderBy('stock', 'desc')
                ->take(5)
                ->get();

            // --- Top suppliers ---
            $topSuppliers = Supplier::withCount(['products' => function ($q) use ($categoryId, $dateFrom, $dateTo) {
                if ($categoryId) $q->where('category_id', $categoryId);
                if ($dateFrom)   $q->whereDate('created_at', '>=', $dateFrom);
                if ($dateTo)     $q->whereDate('created_at', '<=', $dateTo);
            }])
            ->when($supplierId, fn($q) => $q->where('id', $supplierId))
            ->orderBy('products_count', 'desc')
            ->take(5)
            ->get();

            // --- All products table ---
            $allProducts = (clone $productQuery)
                ->with(['category', 'supplier', 'variants'])
                ->get()
                ->map(function ($product) {
                    $product->total_stock  = $product->variants->sum('stock');
                    $product->variant_count = $product->variants->count();
                    return $product;
                })
                ->sortByDesc('total_stock')
                ->take(10);

        } catch (\Exception $e) {
            // Tables not ready yet
        }

        // Active filter count for badge
        $activeFilters = collect([$categoryId, $supplierId, $dateFrom, $dateTo])->filter()->count();

        return view('reports.index', compact(
            'totalProducts', 'totalSuppliers', 'totalCategories',
            'totalVariants', 'totalStockValue', 'lowStockCount',
            'stockLabels', 'stockData', 'healthyStock', 'lowStockData',
            'categoryLabels', 'categoryData',
            'lowStockItems', 'topProducts', 'topSuppliers', 'allProducts',
            'categories', 'suppliers',
            'categoryId', 'supplierId', 'dateFrom', 'dateTo',
            'activeFilters'
        ));
    }
}