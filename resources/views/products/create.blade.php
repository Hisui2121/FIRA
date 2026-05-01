<x-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>

<div class="hero">
    <div class="hero-content">
        <div class="card w-full">
            <div class="card-body">
<h1>Add Product</h1>

@if($errors->any())
    <ul style="color:red;">
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endif

<form action="{{route('products.store')}}" method="POST">
    @csrf

    <label>Category:</label>
    <select name="category_id" required>
        <option value="">-- Select Category --</option>

        @foreach($categories as $category)
            <option value="{{ $category->id }}">
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    <input type="text" name="new_category" placeholder="Or create new category">
    <br><br>

    <label>Name:</label>
    <input type="text" name="name" required><br><br>

    <label>SKU:</label>
    <input type="text" name="sku" required placeholder="e.g. TS-001"><br><br>

    <label>Base Price:</label>
    <input type="number" step="0.01" name="price" required><br><br>

    <label>Description:</label>
    <textarea name="description" cols="30" rows="4"></textarea><br><br>

    <label>Supplier:</label>
    <select name="supplier_id" required>
        <option value="">-- Select Supplier --</option>

        @foreach($suppliers as $supplier)
            <option value="{{ $supplier->id }}">
                {{ $supplier->name }}
            </option>
        @endforeach
    </select>

<br><br>

    <!-- 🔥 VARIANT TABLE -->
    <h3>Variants (Inventory)</h3>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Size</th>
                <th>Color</th>
                <th>Stock</th>
                <th>Price Override</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody id="variantTable">
            <tr>
                <td><input type="text" name="variants[0][size]" required></td>
                <td><input type="text" name="variants[0][color]" required></td>
                <td><input type="number" name="variants[0][stock]" min="0" required></td>
                <td><input type="number" step="0.01" name="variants[0][price_override]"></td>
                <td><button type="button" onclick="removeRow(this)">Remove</button></td>
            </tr>
        </tbody>
    </table>

    <br>
    <button type="button" onclick="addRow()">+ Add Variant</button>

    <br><br>
    <button type="submit">Add Product</button>
</form>

<br>
<a href="{{route('products.index')}}">Back to Catalog</a>

<!-- 🔥 SIMPLE JS FOR DYNAMIC ROWS -->
<script>
let index = 1;

function addRow() {
    let table = document.getElementById('variantTable');

    let row = `
        <tr>
            <td><input type="text" name="variants[${index}][size]" required></td>
            <td><input type="text" name="variants[${index}][color]" required></td>
            <td><input type="number" name="variants[${index}][stock]" min="0" required></td>
            <td><input type="number" step="0.01" name="variants[${index}][price_override]"></td>
            <td><button type="button" onclick="removeRow(this)">Remove</button></td>
        </tr>
    `;

    table.insertAdjacentHTML('beforeend', row);
    index++;
}

function removeRow(button) {
    button.closest('tr').remove();
}
</script>

</body>
</html>
</x-layout>