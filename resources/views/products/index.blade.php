<x-layout>
<x-slot:title>Products Catalog</x-slot:title>

<div class="hero">
    <div class="hero-content">
        <div class="card w-full">
            <div class="card-body">

                <h1 class="text-2xl font-bold mb-4">Fashion Inventory</h1> <br>
                @can('create', App\Models\Product::class)
                <a href="{{ route('products.create') }}" class="btn btn-primary mb-4">
                    Add Product
                </a>
                @endcan <br><br>

                <form method="GET" class="filter-bar" style="margin-bottom:15px; display:flex; gap:10px;">

                <!-- CATEGORY FILTER -->
                <select name="category_id">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <!-- SUPPLIER FILTER -->
                <select name="supplier_id">
                    <option value="">All Suppliers</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}"
                            {{ request('supplier_id') == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="btn">Filter</button>
                <a href="/products" class="btn">Reset</a>
                
            </form> <br><br>
            <div class="table-controls">

                <button onclick="zoomOut()">-</button>

                <span id="zoomLevel">100%</span>

                <button onclick="zoomIn()">+</button>

            </div>

            <div class="table-wrapper">

            <div id="zoomTable" class="zoom-container">

                <table class="spreadsheet-table">
                <thead>
                    <tr>

                        <th>
                            SKU
                            <div class="resize-handle"></div>
                        </th>

                        <th>
                            Product
                            <div class="resize-handle"></div>
                        </th>

                        <th>
                            Size
                            <div class="resize-handle"></div>
                        </th>

                        <th>
                            Color
                            <div class="resize-handle"></div>
                        </th>

                        <th>
                            Price
                            <div class="resize-handle"></div>
                        </th>

                        <th>
                            Stock
                            <div class="resize-handle"></div>
                        </th>

                        <th>
                            Stock In
                            <div class="resize-handle"></div>
                        </th>

                        <th>
                            Stock Out
                            <div class="resize-handle"></div>
                        </th>

                        <th>
                            Actions
                            <div class="resize-handle"></div>
                        </th>

                    </tr>
                    </thead>

                    <tbody>
                        @foreach($products as $product)

                            @foreach($product->variants as $variant)
                                <tr>
                                    <td>{{ $variant->sku }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $variant->size }}</td>
                                    <td>{{ $variant->color }}</td>
                                    <td>{{ number_format($variant->actualPrice(), 2) }}</td>
                                    <td>{{ $variant->stock }}</td>

                                    <!-- STOCK IN -->
                                    <td>
                                    <form action="{{ route('products.stockin', $variant->id) }}" method="POST">
                                        @csrf
                                            <input type="number" name="quantity" min="1" required style="width:70px;">
                                            <button type="submit">+</button>
                                        </form>
                                    </td>

                                    <!-- STOCK OUT -->
                                    <td>
                                    <form action="{{ route('products.stockout', $variant->id) }}" method="POST">
                                        @csrf
                                            <input type="number" name="quantity" min="1" required style="width:70px;">
                                            <button type="submit">-</button>
                                        </form>
                                    </td>
                                    <td style="position:relative;">
                                        <button onclick="toggleMenu(this)" class="btn">⋮</button>

                                        <div class="menu-dropdown" style="display:none; position:absolute; right:0; background:white; border:1px solid #ccc; z-index:10;">
                                            <div class="dropdown">
                                            
                                            @can('update', $product)
                                                <a href="{{ route('products.edit', $product->id) }}" class="dropdown-items">Edit</a><br>
                                            @endcan

                                            @can('delete', $product)
                                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Delete this product?')" class="">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endcan

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
                

            </div>
        </div>
    </div>
</div>
<script>
function toggleMenu(btn) {
    const menu = btn.nextElementSibling;
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
}
</script>

<script>
document.querySelectorAll(".resize-handle").forEach(handle => {

    let startX;
    let startWidth;

    handle.addEventListener("mousedown", function(e) {

        startX = e.pageX;

        const th = handle.parentElement;

        startWidth = th.offsetWidth;

        function mouseMove(e) {

            const newWidth = startWidth + (e.pageX - startX);

            th.style.width = newWidth + "px";
        }

        function mouseUp() {
            document.removeEventListener("mousemove", mouseMove);
            document.removeEventListener("mouseup", mouseUp);
        }

        document.addEventListener("mousemove", mouseMove);
        document.addEventListener("mouseup", mouseUp);

    });

});
</script>
<script>

let zoom = 1;

function updateZoom() {

    const table = document.getElementById("zoomTable");

    table.style.transform = `scale(${zoom})`;

    document.getElementById("zoomLevel").innerText =
        Math.round(zoom * 100) + "%";
}

function zoomIn() {

    zoom += 0.1;

    updateZoom();
}

function zoomOut() {

    if (zoom > 0.5) {

        zoom -= 0.1;

        updateZoom();
    }
}

</script>
</x-layout>