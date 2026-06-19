<x-layout>
    <x-slot name="title">Categories</x-slot>
 
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/category.css') }}">
    @endpush
 
    {{-- Flash Messages --}}
    @if (session('success'))
        <div class="cat-alert success">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
            {{ session('success') }}
        </div>
    @endif
 
    @if (session('error'))
        <div class="cat-alert error">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
            </svg>
            {{ session('error') }}
        </div>
    @endif
 
    {{-- Page Header --}}
    <div class="cat-header">
        <div class="cat-header__titles">
            <h1>Category Catalog</h1>
            <p>Manage your product categories and keep your inventory organised.</p>
        </div>
        @can('create', App\Models\Category::class)
            <a href="{{ route('categories.create') }}" class="btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Add Category
            </a>
        @endcan
    </div>
 
    {{-- Search & Sort Filter Card --}}
    <form method="GET" action="{{ route('categories.index') }}">
        <div class="cat-filter-card">
            <div class="filter-group">
                <label for="search">Search</label>
                <input type="text" id="search" name="search" placeholder="Search by name or description…"
                    value="{{ $search ?? '' }}">
            </div>
 
            <div class="filter-group" style="max-width: 180px;">
                <label for="sort">Sort By</label>
                <select id="sort" name="sort">
                    <option value="name" {{ $sort === 'name' ? 'selected' : '' }}>Name</option>
                    <option value="products_count" {{ $sort === 'products_count' ? 'selected' : '' }}>Product Count</option>
                    <option value="created_at" {{ $sort === 'created_at' ? 'selected' : '' }}>Date Created</option>
                </select>
            </div>
 
            <div class="filter-group" style="max-width: 140px;">
                <label for="direction">Order</label>
                <select id="direction" name="direction">
                    <option value="asc" {{ $direction === 'asc' ? 'selected' : '' }}>Ascending</option>
                    <option value="desc" {{ $direction === 'desc' ? 'selected' : '' }}>Descending</option>
                </select>
            </div>
 
            <div class="filter-actions">
                <button type="submit" class="btn-primary">Filter</button>
                <a href="{{ route('categories.index') }}" class="btn-secondary">Reset</a>
            </div>
        </div>
    </form>
 
    {{-- Table Card --}}
    <div class="cat-table-card">
        <table class="cat-table">
            <thead>
                <tr>
                    <th>
                        <a href="{{ route('categories.index', array_merge(request()->query(), ['sort' => 'name', 'direction' => ($sort === 'name' && $direction === 'asc') ? 'desc' : 'asc'])) }}">
                            Name
                            @if ($sort === 'name')
                                {!! $direction === 'asc' ? '↑' : '↓' !!}
                            @endif
                        </a>
                    </th>
                    <th>Description</th>
                    <th>
                        <a href="{{ route('categories.index', array_merge(request()->query(), ['sort' => 'products_count', 'direction' => ($sort === 'products_count' && $direction === 'asc') ? 'desc' : 'asc'])) }}">
                            Products
                            @if ($sort === 'products_count')
                                {!! $direction === 'asc' ? '↑' : '↓' !!}
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('categories.index', array_merge(request()->query(), ['sort' => 'created_at', 'direction' => ($sort === 'created_at' && $direction === 'asc') ? 'desc' : 'asc'])) }}">
                            Created
                            @if ($sort === 'created_at')
                                {!! $direction === 'asc' ? '↑' : '↓' !!}
                            @endif
                        </a>
                    </th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td class="cat-name">{{ $category->name }}</td>
                        <td class="cat-desc">
                            {{ $category->description ? \Illuminate\Support\Str::limit($category->description, 80) : '—' }}
                        </td>
                        <td class="cat-count">
                            <span class="badge-count">{{ $category->products_count }}</span>
                        </td>
                        <td style="color:#888; font-size:0.82rem;">
                            {{ $category->created_at->format('M d, Y') }}
                        </td>
                        <td>
                            <div class="cat-actions">
                                @can('update', $category)
                                    <a href="{{ route('categories.edit', $category) }}" class="action-link edit">Edit</a>
                                @endcan
                                @can('delete', $category)
                                    <form method="POST" action="{{ route('categories.destroy', $category) }}"
                                        onsubmit="return confirm('Delete category \'{{ addslashes($category->name) }}\'? This cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-link delete"
                                            style="border:none; cursor:pointer;">Delete</button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="cat-empty">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 7h18M3 12h18M3 17h10" />
                                </svg>
                                <strong>No categories found</strong>
                                <p>Try adjusting your search, or add your first category.</p>
                                @can('create', App\Models\Category::class)
                                    <a href="{{ route('categories.create') }}" class="btn-primary">Add Category</a>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
 
        {{-- Pagination --}}
        @if ($categories->hasPages())
            <div class="cat-pagination">
                <span>Showing {{ $categories->firstItem() }}–{{ $categories->lastItem() }} of
                    {{ $categories->total() }} categories</span>
                <div class="pagination-links">
                    {{-- Previous --}}
                    @if ($categories->onFirstPage())
                        <span class="disabled">&lsaquo;</span>
                    @else
                        <a href="{{ $categories->previousPageUrl() }}">&lsaquo;</a>
                    @endif
 
                    {{-- Page Numbers --}}
                    @foreach ($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
                        @if ($page == $categories->currentPage())
                            <span class="active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
 
                    {{-- Next --}}
                    @if ($categories->hasMorePages())
                        <a href="{{ $categories->nextPageUrl() }}">&rsaquo;</a>
                    @else
                        <span class="disabled">&rsaquo;</span>
                    @endif
                </div>
            </div>
        @endif
    </div>
</x-layout>