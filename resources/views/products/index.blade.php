<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Catalog</title>
</head>
<body>
    
    <h1>Products</h1>

    <a href="{{route('products.create')}}" class="">Add a Product</a>

    @foreach($products as $product)
        <p> {{$product->name}} </p>

        <select name="variant_id">
        @foreach($product->variants as $variant)
        
            <option value="{{$variant->id}}">
                Size:{{$variant->size}} |
                Color:{{$variant->color}} |
                Price: ${{number_format($variant->actualPrice(),2)}} |
                Stock: {{$variant->stock}}
            </option>
        @endforeach
    </select>
        <form action="/stockin/{{ $variant->id }}"method= "POST"> 
            @csrf
            <input type="number" name="quantity" placeholder="Stock In">
            <button type="submit">Stock In</button>
        </form>
        <form action="/stockout/{{ $variant->id }}" method="POST">
            @csrf
            <input type="number" name="quantity" placeholder="Stock Out">
            <button type="submit">Stock Out</button>
        </form>
    @endforeach

</body>
</html>