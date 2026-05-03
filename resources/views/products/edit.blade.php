<x-layout>
<x-slot:title>Edit Product</x-slot:title>

<div class="card">
    <div class="card-body">

        <h1>Edit Product</h1>

        <form method="POST" action="{{ route('products.update', $product->id) }}">
            @csrf
            @method('PUT')

            <label>Name</label>
            <input type="text" name="name" value="{{ $product->name }}" required>

            <label>SKU</label>
            <input type="text" name="sku" value="{{ $product->sku }}" required>

            <label>Price</label>
            <input type="number" name="price" value="{{ $product->price }}" required>

            <label>Category</label>
            <select name="category_id">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}"
                        {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>

            <label>Supplier</label>
            <select name="supplier_id">
                @foreach($suppliers as $sup)
                    <option value="{{ $sup->id }}"
                        {{ $product->supplier_id == $sup->id ? 'selected' : '' }}>
                        {{ $sup->name }}
                    </option>
                @endforeach
            </select>

            <br><br>

            <button type="submit" class="btn btn-primary">
                Update Product
            </button>

            <a href="{{ route('products.index') }}" class="btn">
                Cancel
            </a>
        </form>

    </div>
</div>

</x-layout>