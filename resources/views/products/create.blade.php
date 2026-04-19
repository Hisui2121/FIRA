<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>
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

        <label>Name:</label>
        <input type="text" name="name" required> <br> <br>

        <label>Base Price:</label>
        <input type="number" step="0.01" name="base_price" required><br><br>
        <label>Description</label>
        <textarea name="description"cols="30" rows="4"></textarea><br><br>

        <button type="submit">Add Product</button>
    </form>

    <h3>Optional Variant</h3>
    <form action="{{route('variants.store')}}" method="post">
    @csrf
        <label>Select Product:</label>
        <select name="product_id">
            @foreach($products as $product)
            <option value="{{$product->id}}">
                {{$product->name}}
            </option>
            @endforeach
        </select>
        <br><br>
        <label>Size:</label>
        <input type="text" name="size"><br><br>
        <label>Color:</label>
        <input type="text" name="color"><br><br>
        <label>Stock:</label>
        <input type="number" name="stock" min="0"><br><br>
        <label>Price Override:</label>
        <input type="number" name="price_override"><br><br>

        <button type="submit">Add Variant</button>
    </form>
    <br>
    <a href="{{route('products.index')}}">Back to Catalog</a>
</body>
</html>