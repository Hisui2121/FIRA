<x-layout>
<x-slot:title>Reports</x-slot:title>

<div class="reports-page">

    {{-- HEADER --}}
    <div class="reports-header">
        <h1>Inventory Stock Summary Report</h1>
        <p>A detailed overview of your fashion inventory performance.</p>
    </div>

    {{-- SUMMARY BANNER --}}
    <div class="reports-banner">
        <div class="banner-card dark">
            <span class="banner-label">Total Stock Value</span>
            <span class="banner-value">
                ₱{{ number_format($totalStockValue, 2) }}
            </span>
        </div>
        <div class="banner-card dark">
            <span class="banner-label">Total Variants</span>
            <span class="banner-value">{{ $totalVariants }}</span>
        </div>
    </div>

    {{-- STAT CARDS --}}
    <div class="reports-stats">
        <div class="report-card">
            <span class="report-card-label">Total Products</span>
            <span class="report-card-value">{{ $totalProducts }}</span>
        </div>
        <div class="report-card">
            <span class="report-card-label">Total Suppliers</span>
            <span class="report-card-value suppliers">{{ $totalSuppliers }}</span>
        </div>
        <div class="report-card">
            <span class="report-card-label">Low Stock Items</span>
            <span class="report-card-value low">{{ $lowStockCount }}</span>
        </div>
        <div class="report-card">
            <span class="report-card-label">Categories</span>
            <span class="report-card-value categories">{{ $totalCategories }}</span>
        </div>
    </div>

    {{-- CHARTS ROW --}}
    <div class="reports-charts">
        <div class="chart-box">
            <div class="chart-box-header">Stock by Category</div>
            <canvas id="stockBarChart"></canvas>
        </div>
        <div class="chart-box">
            <div class="chart-box-header">Stock Quantity by Category</div>
            <canvas id="stockLineChart"></canvas>
        </div>
    </div>

    <div class="reports-charts">
        <div class="chart-box">
            <div class="chart-box-header">Category Split</div>
            <canvas id="categoryDonutChart"></canvas>
        </div>
        <div class="chart-box">
            <div class="chart-box-header">Stock Balance (Low vs Healthy)</div>
            <canvas id="stockBalanceChart"></canvas>
        </div>
    </div>

    {{-- LOW STOCK TABLE --}}
    <div class="reports-table-box">
        <h3>
            Low Stock Items
            <span class="badge-low">Below 10</span>
        </h3>
        <table class="reports-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>SKU</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Stock</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($lowStockItems as $item)
                <tr>
                    <td>{{ $item->product->name ?? 'N/A' }}</td>
                    <td>{{ $item->sku }}</td>
                    <td>{{ $item->size }}</td>
                    <td>{{ $item->color }}</td>
                    <td>{{ $item->stock }}</td>
                    <td>
                        @if($item->stock == 0)
                            <span class="status-badge out">Out of Stock</span>
                        @else
                            <span class="status-badge low">Low Stock</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="empty-row">No low stock items.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- TOP PRODUCTS TABLE --}}
    <div class="reports-table-box">
        <h3>Top 5 Products by Stock</h3>
        <table class="reports-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>SKU</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                @forelse($topProducts as $item)
                <tr>
                    <td>{{ $item->product->name ?? 'N/A' }}</td>
                    <td>{{ $item->sku }}</td>
                    <td>{{ $item->size }}</td>
                    <td>{{ $item->color }}</td>
                    <td>{{ $item->stock }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="empty-row">No products found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const YELLOW = '#fdbf29';
    const DARK   = '#241f26';
    const GREY   = '#a0a0a0';
    const LIGHT  = '#e8e8e8';

    // 1. Bar Chart — Stock by Category
    new Chart(document.getElementById('stockBarChart'), {
        type: 'bar',
        data: {
            labels: @json($stockLabels),
            datasets: [{
                label: 'Stock',
                data: @json($stockData),
                backgroundColor: [YELLOW, DARK, GREY, '#f0b020', '#c0c0c0'],
                borderRadius: 6,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: '#f0f0f0' } },
                x: { grid: { display: false } }
            }
        }
    });

    // 2. Line Chart — Stock Quantity
    new Chart(document.getElementById('stockLineChart'), {
        type: 'line',
        data: {
            labels: @json($stockLabels),
            datasets: [{
                label: 'Stock Quantity',
                data: @json($stockData),
                borderColor: YELLOW,
                backgroundColor: 'rgba(253,191,41,0.15)',
                pointBackgroundColor: YELLOW,
                pointRadius: 5,
                fill: true,
                tension: 0.4,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: '#f0f0f0' } },
                x: { grid: { display: false } }
            }
        }
    });

    // 3. Donut Chart — Category Split
    new Chart(document.getElementById('categoryDonutChart'), {
        type: 'doughnut',
        data: {
            labels: @json($categoryLabels),
            datasets: [{
                data: @json($categoryData),
                backgroundColor: [YELLOW, DARK, GREY, '#f0b020', LIGHT],
                borderWidth: 2,
                borderColor: '#fff',
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'bottom' } },
            cutout: '65%'
        }
    });

    // 4. Horizontal Bar — Stock Balance
    new Chart(document.getElementById('stockBalanceChart'), {
        type: 'bar',
        data: {
            labels: @json($stockLabels),
            datasets: [
                {
                    label: 'Healthy Stock',
                    data: @json($healthyStock),
                    backgroundColor: DARK,
                    borderRadius: 4,
                },
                {
                    label: 'Low Stock',
                    data: @json($lowStockData),
                    backgroundColor: YELLOW,
                    borderRadius: 4,
                }
            ]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            },
            scales: {
                x: { beginAtZero: true, grid: { color: '#f0f0f0' } },
                y: { grid: { display: false } }
            }
        }
    });
</script>

</x-layout>