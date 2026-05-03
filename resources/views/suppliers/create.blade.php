<x-layout>
    <x-slot:title>Add Supplier</x-slot:title>

    <form method="POST" action="{{ route('suppliers.store') }}" enctype="multipart/form-data">
        @csrf

        <input type="text" name="name" placeholder="Company Name" required>
        <input type="email" name="email" placeholder="Email">
        <input type="text" name="phone" placeholder="Phone">
        <textarea name="address" placeholder="Address"></textarea>

        <input type="file" name="logo">

        <button type="submit">Save</button>
    </form>
</x-layout>