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

    <!-- CHART.JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        console.log("Dashboard chart script executed");
        document.addEventListener("DOMContentLoaded", () => {

        // prevent double execution (THIS IS KEY)
        if (window.__dashboardChartsLoaded) return;
        window.__dashboardChartsLoaded = true;

        const barCanvas = document.getElementById('barChart');
        const donutCanvas = document.getElementById('donutChart');

        // destroy safely
        if (window.barChartInstance) window.barChartInstance.destroy();
        if (window.donutChartInstance) window.donutChartInstance.destroy();

        // wait 1 frame so layout fully stabilizes
        requestAnimationFrame(() => {

            window.barChartInstance = new Chart(barCanvas, {
                type: 'bar',
                data: {
                    labels: @json($stockLabels ?? []),
                    datasets: [{
                        data: @json($stockData ?? []),
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: false,
                    resizeDelay: 200,
                    plugins: { legend: { display: false } }
                }
            });

            window.donutChartInstance = new Chart(donutCanvas, {
                type: 'doughnut',
                data: {
                    labels: @json($categoryLabels ?? []),
                    datasets: [{
                        data: @json($categoryData ?? [])
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,

                    resizeDelay: 300,

                    animation: {
                        duration: 0
                    },

                    cutout: '65%'
                }
            });

        });
        });
    </script>
</x-layout>