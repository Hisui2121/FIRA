<h1>Products</h1>

@foreach($products as $product)
    <p>{{ $product->name }} - {{ $product->stock }}</p>
@endforeach

<h2>Hello World</h2>

<h2>T-SHIRT</h2>