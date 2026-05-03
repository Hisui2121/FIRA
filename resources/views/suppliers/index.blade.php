<x-layout>
    <x-slot:title>Suppliers</x-slot:title>

    <div class="page-header">
        <h2>Suppliers</h2> <br> <br>
        <a href="{{ route('suppliers.create') }}" class="btn btn-primary">+ Add Supplier</a>
    </div>

    <div class="supplier-grid">

    @foreach($suppliers as $supplier)
<div class="supplier-card">

    <!-- 3 DOT MENU -->
    <div class="menu">
        <button onclick="toggleMenu({{ $supplier->id }})">⋮</button>

        <div id="menu-{{ $supplier->id }}" class="dropdown hidden">
            <a href="{{ route('suppliers.edit', $supplier) }}">Edit</a>

            <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Delete this supplier?')">
                    Delete
                </button>            
            </form>
        </div>
    </div>

    <!-- CLICKABLE CARD -->
    <a href="{{ route('suppliers.show', $supplier) }}">
        <div class="logo">
            @if($supplier->logo)
                <img src="{{ asset('storage/' . $supplier->logo) }}">
            @else
                <div class="placeholder">🏢</div>
            @endif
        </div>

        <h4>{{ $supplier->name }}</h4>
    </a>

</div>
@endforeach

    </div>
    <script>
function toggleMenu(id) {
    const menu = document.getElementById('menu-' + id);
    menu.classList.toggle('hidden');
}
</script>
</x-layout>