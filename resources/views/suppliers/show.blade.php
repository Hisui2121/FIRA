<x-layout>
    <x-slot:title>{{ $supplier->name }}</x-slot:title>

    <div class="card">

        <div class="logo">
            @if($supplier->logo)
                <img src="{{ asset('storage/' . $supplier->logo) }}">
            @endif
        </div>

        <h2>{{ $supplier->name }}</h2>

        <p><strong>Email:</strong> {{ $supplier->email }}</p>
        <p><strong>Phone:</strong> {{ $supplier->phone }}</p>
        <p><strong>Address:</strong> {{ $supplier->address }}</p>

    </div>

    <a href="/suppliers">Back</a>

</x-layout>