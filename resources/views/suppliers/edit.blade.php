<x-layout>
    <x-slot:title>Edit Supplier</x-slot:title>

    <div class="page-header">
        <h2>Edit Supplier</h2>
    </div>

    <form method="POST" action="{{ route('suppliers.update', $supplier) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ $supplier->name }}" required>
        <input type="email" name="email" value="{{ $supplier->email }}">
        <input type="text" name="phone" value="{{ $supplier->phone }}">
        <textarea name="address">{{ $supplier->address }}</textarea>

        <p>Current Logo:</p>
        @if($supplier->logo)
            <img src="{{ asset('storage/' . $supplier->logo) }}" width="80">
        @endif

        <input type="file" name="logo">

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</x-layout>