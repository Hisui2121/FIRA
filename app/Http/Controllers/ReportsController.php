<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\StockTransaction;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportsController extends Controller
{
    /**
     * Per-page size for the paginated product table.
     */
    const PRODUCTS_PER_PAGE = 10;

    public function index(Request $request)
    {
        // --- Filters ---
        $categoryId  = $request->input('category_id');
        $supplierId  = $request->input('supplier_id');
        // NOTE: date_from / date_to filter by actual stock MOVEMENT activity
        // (stock_transactions.created_at), not by when the product record
        // was created. See buildActivityFilteredProductIds().
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

        $trendLabels = [];
        $trendIn     = [];
        $trendOut    = [];
        $trendNet    = [];

        // For filter dropdowns
        $categories = Category::orderBy('name')->get();
        $suppliers  = Supplier::orderBy('name')->get();

        try {
            // --- Filtered product query builder ---
            // category_id / supplier_id are attributes of the product itself,
            // so they stay simple `where`s against the products table.
            $productQuery = Product::query();

            if ($categoryId) {
                $productQuery->where('category_id', $categoryId);
            }
            if ($supplierId) {
                $productQuery->where('supplier_id', $supplierId);
            }

            // date_from / date_to describe a *report window* — "show me what
            // happened between these dates" — so they must be matched against
            // when stock actually moved (stock_transactions), not against
            // products.created_at. A product created in January can still
            // have stock activity in March, and the report should reflect that.
            if ($dateFrom || $dateTo) {
                $activeProductIds = $this->productIdsWithActivityInRange($dateFrom, $dateTo);
                $productQuery->whereIn('id', $activeProductIds);
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
            $topSuppliers = Supplier::withCount(['products' => function ($q) use ($categoryId, $filteredProductIds) {
                $q->whereIn('id', $filteredProductIds);
                if ($categoryId) $q->where('category_id', $categoryId);
            }])
            ->when($supplierId, fn($q) => $q->where('id', $supplierId))
            ->orderBy('products_count', 'desc')
            ->take(5)
            ->get();

            // --- Stock Trend: real movement history from stock_transactions ---
            // Previously this chart re-plotted the per-category stock snapshot
            // (stockLabels/stockData) as a line, which has nothing to do with
            // a "trend" — it was the same bar-chart numbers reshaped. This now
            // aggregates real IN/OUT transactions, bucketed by day (or month
            // when the range is long), restricted to the filtered products.
            $trend = $this->buildStockTrend($filteredProductIds, $dateFrom, $dateTo);
            $trendLabels = $trend['labels'];
            $trendIn     = $trend['in'];
            $trendOut    = $trend['out'];
            $trendNet    = $trend['net'];

            // --- All products table (paginated, NOT capped at 10 silently) ---
            // Sorting by total stock requires aggregating in PHP (stock lives
            // on variants), so we sort the filtered set first, then slice the
            // requested page out of it and wrap it in a real paginator. This
            // keeps the existing "top stock first" ordering while letting
            // users reach every row via page links, and the CSV export below
            // can still pull the *entire* filtered set regardless of page.
            $allFilteredProducts = (clone $productQuery)
                ->with(['category', 'supplier', 'variants'])
                ->get()
                ->map(function ($product) {
                    $product->total_stock   = $product->variants->sum('stock');
                    $product->variant_count = $product->variants->count();
                    return $product;
                })
                ->sortByDesc('total_stock')
                ->values();

            $perPage    = self::PRODUCTS_PER_PAGE;
            $page       = (int) $request->input('page', 1);
            $page       = $page < 1 ? 1 : $page;
            $totalRows  = $allFilteredProducts->count();
            $pageItems  = $allFilteredProducts->slice(($page - 1) * $perPage, $perPage)->values();

            $allProducts = new \Illuminate\Pagination\LengthAwarePaginator(
                $pageItems,
                $totalRows,
                $perPage,
                $page,
                [
                    'path'  => $request->url(),
                    'query' => $request->except('page'),
                ]
            );

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
            'trendLabels', 'trendIn', 'trendOut', 'trendNet',
            'lowStockItems', 'topProducts', 'topSuppliers', 'allProducts',
            'categories', 'suppliers',
            'categoryId', 'supplierId', 'dateFrom', 'dateTo',
            'activeFilters'
        ));
    }

    /**
     * Export every product matching the current filters as CSV — ignoring
     * the 10-row cap used for the on-screen table. Honors the same
     * category_id / supplier_id / date_from / date_to filters as the report.
     */
    public function exportCsv(Request $request): StreamedResponse
    {
        $categoryId = $request->input('category_id');
        $supplierId = $request->input('supplier_id');
        $dateFrom   = $request->input('date_from');
        $dateTo     = $request->input('date_to');

        $productQuery = Product::query()->with(['category', 'supplier', 'variants']);

        if ($categoryId) {
            $productQuery->where('category_id', $categoryId);
        }
        if ($supplierId) {
            $productQuery->where('supplier_id', $supplierId);
        }
        if ($dateFrom || $dateTo) {
            $activeProductIds = $this->productIdsWithActivityInRange($dateFrom, $dateTo);
            $productQuery->whereIn('id', $activeProductIds);
        }

        $filename = 'stock-report-' . now()->format('Y-m-d_His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($productQuery) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, [
                'Product', 'SKU', 'Category', 'Supplier',
                'Sizes', 'Colors', 'Total Stock', 'Unit Price', 'Stock Value',
            ]);

            // Stream in chunks so a large catalog doesn't have to be loaded
            // into memory all at once.
            $productQuery->orderBy('id')->chunk(200, function ($products) use ($handle) {
                foreach ($products as $product) {
                    $totalStock = $product->variants->sum('stock');
                    $sizes      = $product->variants->pluck('size')->unique()->sort()->implode(', ');
                    $colors     = $product->variants->pluck('color')->unique()->sort()->implode(', ');

                    fputcsv($handle, [
                        $product->name,
                        $product->sku,
                        $product->category->name ?? '—',
                        $product->supplier->name ?? '—',
                        $sizes,
                        $colors,
                        $totalStock,
                        number_format($product->price, 2),
                        number_format($product->price * $totalStock, 2),
                    ]);
                }
            });

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * IDs of products that had at least one stock_transactions entry
     * (the real signal of "activity") within the given date range.
     * This is what the date_from / date_to filters actually bound.
     */
    private function productIdsWithActivityInRange(?string $dateFrom, ?string $dateTo): \Illuminate\Support\Collection
    {
        $query = StockTransaction::query()
            ->join('product_variants', 'stock_transactions.variant_id', '=', 'product_variants.id');

        if ($dateFrom) {
            $query->whereDate('stock_transactions.created_at', '>=', $dateFrom);
        }
        if ($dateTo) {
            $query->whereDate('stock_transactions.created_at', '<=', $dateTo);
        }

        return $query->distinct()->pluck('product_variants.product_id');
    }

    /**
     * Build a real time-series of stock movement (IN / OUT / net) for the
     * given set of product IDs, bucketed by day if the range is 60 days or
     * fewer, otherwise by month. Falls back to the last 30 days when no
     * explicit range is given, so the chart always shows something
     * meaningful instead of an empty axis.
     */
    private function buildStockTrend(\Illuminate\Support\Collection $productIds, ?string $dateFrom, ?string $dateTo): array
    {
        $to   = $dateTo ? Carbon::parse($dateTo)->endOfDay() : Carbon::now()->endOfDay();
        $from = $dateFrom ? Carbon::parse($dateFrom)->startOfDay() : $to->copy()->subDays(29)->startOfDay();

        if ($from->greaterThan($to)) {
            [$from, $to] = [$to->copy()->startOfDay(), $from->copy()->endOfDay()];
        }

        $spanDays = $from->diffInDays($to) + 1;
        $byMonth  = $spanDays > 60;

        $variantIds = ProductVariant::whereIn('product_id', $productIds)->pluck('id');

        $dateExpr = $byMonth ? "strftime('%Y-%m', stock_transactions.created_at)" : "DATE(stock_transactions.created_at)";
        // SQLite (used in this project's default config) supports strftime;
        // most other drivers Laravel ships against support DATE()/DATE_FORMAT
        // equivalents — kept simple here since the app runs on SQLite.
        if (DB::getDriverName() !== 'sqlite') {
            $dateExpr = $byMonth ? "DATE_FORMAT(stock_transactions.created_at, '%Y-%m')" : "DATE(stock_transactions.created_at)";
        }

        $rows = StockTransaction::query()
            ->whereIn('variant_id', $variantIds)
            ->whereBetween('stock_transactions.created_at', [$from, $to])
            ->selectRaw("$dateExpr as bucket, type, SUM(quantity) as qty")
            ->groupBy('bucket', 'type')
            ->orderBy('bucket')
            ->get();

        // Build the full list of buckets up front so days/months with zero
        // activity still show up as 0 instead of being skipped.
        $buckets = collect();
        $cursor  = $from->copy();
        while ($cursor->lessThanOrEqualTo($to)) {
            $key = $byMonth ? $cursor->format('Y-m') : $cursor->format('Y-m-d');
            $buckets->put($key, ['in' => 0, 'out' => 0]);
            $cursor = $byMonth ? $cursor->addMonth() : $cursor->addDay();
        }

        foreach ($rows as $row) {
            if (!$buckets->has($row->bucket)) {
                continue;
            }
            $field = $row->type === 'IN' ? 'in' : 'out';
            $bucket = $buckets->get($row->bucket);
            $bucket[$field] += (int) $row->qty;
            $buckets->put($row->bucket, $bucket);
        }

        $labels = [];
        $in     = [];
        $out    = [];
        $net    = [];

        foreach ($buckets as $key => $values) {
            $labels[] = $byMonth ? Carbon::createFromFormat('Y-m', $key)->format('M Y') : Carbon::createFromFormat('Y-m-d', $key)->format('M j');
            $in[]     = $values['in'];
            $out[]    = $values['out'];
            $net[]    = $values['in'] - $values['out'];
        }

        return compact('labels', 'in', 'out', 'net');
    }
}