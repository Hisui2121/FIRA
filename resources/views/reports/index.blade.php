<x-layout>
<x-slot:title>Reports</x-slot:title>

<div class="rp-page">

    {{-- PAGE HEADER --}}
    <div class="rp-header">
        <div class="rp-header-left">
            <span class="rp-eyebrow">Inventory Report</span>
            <h1 class="rp-title">Stock Summary</h1>
            <p class="rp-subtitle">Generated {{ now()->format('F j, Y \a\t g:i A') }}</p>
        </div>
        <button class="rp-export-btn" onclick="window.print()">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
            </svg>
            Export PDF
        </button>
    </div>

    {{-- FILTER BAR --}}
    <form method="GET" action="{{ route('reports.index') }}" class="rp-filter-bar" id="filterForm">
        <div class="rp-filter-group">
            <label class="rp-filter-label">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a2 2 0 012-2z"/></svg>
                Category
            </label>
            <select name="category_id" class="rp-filter-select" onchange="this.form.submit()">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $categoryId == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="rp-filter-group">
            <label class="rp-filter-label">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                Supplier
            </label>
            <select name="supplier_id" class="rp-filter-select" onchange="this.form.submit()">
                <option value="">All Suppliers</option>
                @foreach($suppliers as $sup)
                    <option value="{{ $sup->id }}" {{ $supplierId == $sup->id ? 'selected' : '' }}>
                        {{ $sup->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="rp-filter-group">
            <label class="rp-filter-label">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                From
            </label>
            <input type="date" name="date_from" class="rp-filter-input" value="{{ $dateFrom }}" onchange="this.form.submit()">
        </div>

        <div class="rp-filter-group">
            <label class="rp-filter-label">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                To
            </label>
            <input type="date" name="date_to" class="rp-filter-input" value="{{ $dateTo }}" onchange="this.form.submit()">
        </div>

        <div class="rp-filter-actions">
            @if($activeFilters > 0)
                <a href="{{ route('reports.index') }}" class="rp-clear-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    Clear
                    <span class="rp-filter-count">{{ $activeFilters }}</span>
                </a>
            @endif
        </div>
    </form>

    {{-- ACTIVE FILTER PILLS --}}
    @if($activeFilters > 0)
    <div class="rp-active-filters">
        <span class="rp-active-label">Filtered by:</span>
        @if($categoryId)
            <span class="rp-pill">Category: {{ $categories->firstWhere('id', $categoryId)?->name }}</span>
        @endif
        @if($supplierId)
            <span class="rp-pill">Supplier: {{ $suppliers->firstWhere('id', $supplierId)?->name }}</span>
        @endif
        @if($dateFrom)
            <span class="rp-pill">From: {{ \Carbon\Carbon::parse($dateFrom)->format('M j, Y') }}</span>
        @endif
        @if($dateTo)
            <span class="rp-pill">To: {{ \Carbon\Carbon::parse($dateTo)->format('M j, Y') }}</span>
        @endif
    </div>
    @endif

    {{-- SUMMARY STRIP --}}
    <div class="rp-summary-strip">
        <div class="rp-summary-item">
            <span class="rp-summary-value">₱{{ number_format($totalStockValue, 2) }}</span>
            <span class="rp-summary-label">Total Stock Value</span>
        </div>
        <div class="rp-summary-divider"></div>
        <div class="rp-summary-item">
            <span class="rp-summary-value">{{ $totalProducts }}</span>
            <span class="rp-summary-label">Products</span>
        </div>
        <div class="rp-summary-divider"></div>
        <div class="rp-summary-item">
            <span class="rp-summary-value">{{ $totalVariants }}</span>
            <span class="rp-summary-label">Variants</span>
        </div>
        <div class="rp-summary-divider"></div>
        <div class="rp-summary-item">
            <span class="rp-summary-value">{{ $totalSuppliers }}</span>
            <span class="rp-summary-label">Suppliers</span>
        </div>
        <div class="rp-summary-divider"></div>
        <div class="rp-summary-item">
            <span class="rp-summary-value {{ $lowStockCount > 0 ? 'rp-warn' : '' }}">{{ $lowStockCount }}</span>
            <span class="rp-summary-label">Low Stock</span>
        </div>
        <div class="rp-summary-divider"></div>
        <div class="rp-summary-item">
            <span class="rp-summary-value">{{ $totalCategories }}</span>
            <span class="rp-summary-label">Categories</span>
        </div>
    </div>

    {{-- TWO-COLUMN LAYOUT --}}
    <div class="rp-two-col">

        {{-- LEFT: Charts --}}
        <div class="rp-left-col">
            <div class="rp-section-label"><span>Stock Analysis</span></div>

            <div class="rp-chart-card">
                <div class="rp-chart-title">Stock by Category</div>
                <div class="rp-chart-wrap"><canvas id="stockBarChart"></canvas></div>
            </div>

            <div class="rp-chart-card">
                <div class="rp-chart-title">Low vs Healthy Stock</div>
                <div class="rp-chart-wrap"><canvas id="stockBalanceChart"></canvas></div>
            </div>

            <div class="rp-charts-row">
                <div class="rp-chart-card">
                    <div class="rp-chart-title">Category Split</div>
                    <div class="rp-chart-wrap rp-chart-wrap--donut"><canvas id="categoryDonutChart"></canvas></div>
                </div>
                <div class="rp-chart-card">
                    <div class="rp-chart-title">Stock Trend</div>
                    <div class="rp-chart-wrap rp-chart-wrap--donut"><canvas id="stockLineChart"></canvas></div>
                </div>
            </div>
        </div>

        {{-- RIGHT: Suppliers + Low Stock --}}
        <div class="rp-right-col">

            <div class="rp-section-label"><span>Top Suppliers</span></div>
            <div class="rp-card">
                @forelse($topSuppliers as $supplier)
                <div class="rp-supplier-row">
                    <div class="rp-avatar rp-avatar--supplier">
                        @if($supplier->logo)
                            <img src="{{ asset('storage/' . $supplier->logo) }}" alt="{{ $supplier->name }}">
                        @else
                            {{ strtoupper(substr($supplier->name, 0, 1)) }}
                        @endif
                    </div>
                    <div class="rp-supplier-info">
                        <span class="rp-supplier-name">{{ $supplier->name }}</span>
                        <span class="rp-supplier-meta">{{ $supplier->products_count }} {{ Str::plural('product', $supplier->products_count) }}</span>
                    </div>
                    <div class="rp-supplier-bar-wrap">
                        <div class="rp-supplier-bar" style="width: {{ $topSuppliers->max('products_count') > 0 ? round(($supplier->products_count / $topSuppliers->max('products_count')) * 100) : 0 }}%"></div>
                    </div>
                </div>
                @empty
                <p class="rp-empty-sm">No suppliers match filters.</p>
                @endforelse
            </div>

            <div class="rp-section-label">
                <span>Low Stock Alert</span>
                @if($lowStockCount > 0)
                    <span class="rp-badge rp-badge--warn">{{ $lowStockCount }} items</span>
                @endif
            </div>
            <div class="rp-card rp-card--flush">
                @forelse($lowStockItems->take(6) as $item)
                @php $colors = ['#6366f1','#f59e0b','#22c55e','#3b82f6','#ec4899','#f97316']; $c = $colors[($item->product->category_id ?? 1) % 6]; @endphp
                <div class="rp-low-row">
                    <div class="rp-avatar rp-avatar--sm" style="background:{{ $c }}20;color:{{ $c }};">
                        {{ strtoupper(substr($item->product->name ?? 'P', 0, 1)) }}
                    </div>
                    <div class="rp-low-info">
                        <span class="rp-low-name">{{ $item->product->name ?? 'N/A' }}</span>
                        <span class="rp-low-meta">{{ $item->size }} · {{ $item->color }} · {{ $item->sku }}</span>
                    </div>
                    @if($item->stock == 0)
                        <span class="rp-status rp-status--out">Out</span>
                    @else
                        <span class="rp-status rp-status--low">{{ $item->stock }} left</span>
                    @endif
                </div>
                @empty
                <div class="rp-empty-ok">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    All stock levels healthy
                </div>
                @endforelse
            </div>

        </div>
    </div>

    {{-- PRODUCT TABLE --}}
    <div class="rp-section-label">
        <span>Product Inventory</span>
        <span class="rp-badge rp-badge--neutral">Top 10 by Stock</span>
    </div>

    <div class="rp-table-card">
        <table class="rp-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>SKU</th>
                    <th>Category</th>
                    <th>Supplier</th>
                    <th>Sizes</th>
                    <th>Colors</th>
                    <th>Total Stock</th>
                    <th>Unit Price</th>
                    <th>Stock Value</th>
                </tr>
            </thead>
            <tbody>
                @php $avatarColors = ['#6366f1','#f59e0b','#22c55e','#3b82f6','#ec4899','#f97316']; @endphp
                @forelse($allProducts as $i => $product)
                @php $color = $avatarColors[$i % count($avatarColors)]; @endphp
                <tr>
                    <td>
                        <div class="rp-product-cell">
                            <div class="rp-avatar rp-avatar--table" style="background:{{ $color }}20;color:{{ $color }};">
                                {{ strtoupper(substr($product->name, 0, 1)) }}
                            </div>
                            <span class="rp-td-bold">{{ $product->name }}</span>
                        </div>
                    </td>
                    <td class="rp-td-mono">{{ $product->sku }}</td>
                    <td><span class="rp-cat-tag">{{ $product->category->name ?? '—' }}</span></td>
                    <td class="rp-td-muted">{{ $product->supplier->name ?? '—' }}</td>
                    <td>
                        <div class="rp-tag-list">
                            @foreach($product->variants->pluck('size')->unique()->sort() as $size)
                                <span class="rp-tag">{{ $size }}</span>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        <div class="rp-tag-list">
                            @foreach($product->variants->pluck('color')->unique()->sort() as $varColor)
                                <span class="rp-color-chip">
                                    <span class="rp-color-dot" style="background: {{ strtolower($varColor) === 'white' ? '#e5e7eb' : strtolower($varColor) }};"></span>
                                    {{ $varColor }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        <div class="rp-stock-bar-wrap">
                            <div class="rp-stock-bar" style="width:{{ $allProducts->max('total_stock') > 0 ? round(($product->total_stock / $allProducts->max('total_stock')) * 100) : 0 }}%"></div>
                            <span class="rp-td-bold">{{ $product->total_stock }}</span>
                        </div>
                    </td>
                    <td class="rp-td-muted">₱{{ number_format($product->price, 2) }}</td>
                    <td class="rp-td-bold">₱{{ number_format($product->price * $product->total_stock, 2) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="rp-empty">
                        No products match the selected filters.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const cs = getComputedStyle(document.documentElement);
    const PRIMARY = cs.getPropertyValue('--primary').trim()   || '#f4b942';
    const TEXT    = cs.getPropertyValue('--text').trim()      || '#111827';
    const MUTED   = cs.getPropertyValue('--text-soft').trim() || '#9ca3af';
    const BORDER  = cs.getPropertyValue('--border').trim()    || '#e5e7eb';
    const SURFACE = cs.getPropertyValue('--surface').trim()   || '#ffffff';
    const PALETTE = [PRIMARY, '#6366f1', '#22c55e', '#3b82f6', '#f59e0b', '#ec4899'];

    const axisOpts = {
        y: { beginAtZero: true, grid: { color: BORDER }, ticks: { color: MUTED, font: { size: 11 } } },
        x: { grid: { display: false }, ticks: { color: MUTED, font: { size: 11 } } }
    };

    new Chart(document.getElementById('stockBarChart'), {
        type: 'bar',
        data: {
            labels: @json($stockLabels),
            datasets: [{ data: @json($stockData), backgroundColor: @json($stockLabels).map((_, i) => PALETTE[i % PALETTE.length]), borderRadius: 6 }]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: axisOpts }
    });

    new Chart(document.getElementById('stockBalanceChart'), {
        type: 'bar',
        data: {
            labels: @json($stockLabels),
            datasets: [
                { label: 'Healthy', data: @json($healthyStock), backgroundColor: '#22c55e', borderRadius: 4 },
                { label: 'Low',     data: @json($lowStockData), backgroundColor: '#f59e0b', borderRadius: 4 }
            ]
        },
        options: {
            responsive: true, maintainAspectRatio: false, indexAxis: 'y',
            plugins: { legend: { display: true, position: 'bottom', labels: { color: TEXT, boxWidth: 12, padding: 14, font: { size: 11 } } } },
            scales: {
                x: { beginAtZero: true, stacked: true, grid: { color: BORDER }, ticks: { color: MUTED, font: { size: 11 } } },
                y: { stacked: true, grid: { display: false }, ticks: { color: MUTED, font: { size: 11 } } }
            }
        }
    });

    new Chart(document.getElementById('categoryDonutChart'), {
        type: 'doughnut',
        data: {
            labels: @json($categoryLabels),
            datasets: [{ data: @json($categoryData), backgroundColor: PALETTE, borderWidth: 3, borderColor: SURFACE }]
        },
        options: { responsive: true, maintainAspectRatio: false, cutout: '68%', plugins: { legend: { display: true, position: 'bottom', labels: { color: TEXT, boxWidth: 10, padding: 12, font: { size: 11 } } } } }
    });

    new Chart(document.getElementById('stockLineChart'), {
        type: 'line',
        data: {
            labels: @json($stockLabels),
            datasets: [{ data: @json($stockData), borderColor: PRIMARY, backgroundColor: 'rgba(244,185,66,0.08)', pointBackgroundColor: PRIMARY, pointRadius: 4, fill: true, tension: 0.4 }]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: axisOpts }
    });
</script>

</x-layout>