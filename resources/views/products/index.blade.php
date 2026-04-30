<x:layout>
<x-slot:title>Products Catalog</x-slot:title>

<div class="hero">
    <div class="hero-content">
        <div class="card w-full">
            <div class="card-body">

                <h1 class="text-2xl font-bold mb-4">Products</h1>

                <a href="{{route('products.create')}}" class="btn btn-primary mb-4">
                    Add Product
                </a> <br><br>

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

                <table border="1" cellpadding="10" width="100%">
                    <thead>
                        <tr>
                            <th>SKU</th>
                            <th>Product</th>
                            <th>Size</th>
                            <th>Color</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Stock In</th>
                            <th>Stock Out</th>
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
                                    <td>${{ number_format($variant->actualPrice(), 2) }}</td>
                                    <td>{{ $variant->stock }}</td>

                                    <!-- STOCK IN -->
                                    <td>
                                        <form action="/stockin/{{ $variant->id }}" method="POST">
                                            @csrf
                                            <input type="number" name="quantity" min="1" required style="width:70px;">
                                            <button type="submit">+</button>
                                        </form>
                                    </td>

                                    <!-- STOCK OUT -->
                                    <td>
                                        <form action="/stockout/{{ $variant->id }}" method="POST">
                                            @csrf
                                            <input type="number" name="quantity" min="1" required style="width:70px;">
                                            <button type="submit">-</button>
                                        </form>
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

</x:layout>