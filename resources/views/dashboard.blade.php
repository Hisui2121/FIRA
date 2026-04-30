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
</x-layout>