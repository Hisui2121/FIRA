<x-layout>
    <x-slot:title>
        Dashboard
    </x-slot:title>

    <div class="page-header">
        <h2>Dashboard</h2>
        <p>Here's your inventory at a glance.</p>
    </div>

    @if($lowStockCount > 0)
        <div class="alert">
            ⚠ Low Stock Alert: <span>{{ $lowStockCount }} items below threshold</span>
        </div>
    @endif 

    <div class="stats">
        <div class="stat-card">
            <h3>{{ $totalProducts }}</h3>
            <p>Total Products</p>
        </div>

        <div class="stat-card success">
            <h3>{{ $totalSuppliers }}</h3>
            <p>Suppliers</p>
        </div>

        <div class="stat-card warning">
            <h3>{{ $lowStockCount }}</h3>
            <p>Low Stock</p>
        </div>

        <div class="stat-card neutral">
            <h3>{{ $totalCategories }}</h3>
            <p>Categories</p>
        </div>
    </div>

    <!-- CHART GRID -->
    <div class="chart-grid">

    <!-- BAR CHART -->
    <div class="card chart-card">
        <h4>Stock by Category</h4>
        <div class="chart-container">
            <canvas id="barChart"></canvas>
        </div>
    </div>

    <!-- DONUT CHART -->
    <div class="card chart-card">
        <h4>Category Split</h4>
        <div class="chart-container">
            <canvas id="donutChart"></canvas>
        </div>
    </div>

    </div>
    <pre>
Labels: {{ json_encode($stockLabels) }}
Data: {{ json_encode($stockData) }}
</pre>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
document.addEventListener("DOMContentLoaded", () => {

    const barCanvas = document.getElementById('barChart');
    const donutCanvas = document.getElementById('donutChart');

    if (!barCanvas || !donutCanvas) return;

    if (window.barChartInstance) window.barChartInstance.destroy();
    if (window.donutChartInstance) window.donutChartInstance.destroy();

    window.barChartInstance = new Chart(barCanvas, {
        type: 'bar',
        data: {
            labels: @json($stockLabels ?? []),
            datasets: [{
                data: @json($stockData ?? []),
                backgroundColor: '#4f46e5',
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }
        }
    });

    window.donutChartInstance = new Chart(donutCanvas, {
        type: 'doughnut',
        data: {
            labels: @json($categoryLabels ?? []),
            datasets: [{
                data: @json($categoryData ?? []),
                backgroundColor: ['#4f46e5', '#22c55e', '#f59e0b', '#ef4444']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%'
        }
    });

});
</script>
</x-layout>