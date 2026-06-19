<x-layout>
    <x-slot name="title">Edit Category</x-slot>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/category.css') }}">
    @endpush

    {{-- Breadcrumb --}}
    <nav class="cat-breadcrumb">
        <a href="{{ route('categories.index') }}">Categories</a>
        <span class="sep">›</span>
        <span class="current">Edit: {{ $category->name }}</span>
    </nav>

    {{-- Page Header --}}
    <div class="cat-header">
        <div class="cat-header__titles">
            <h1>Edit Category</h1>
            <p>Update the details for <strong>{{ $category->name }}</strong>.</p>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="cat-form-card">
        <form method="POST" action="{{ route('categories.update', $category) }}">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div class="form-group">
                <label for="name">Category Name <span style="color:#e74c3c">*</span></label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="e.g. Shoes, Tops, Accessories…"
                    value="{{ old('name', $category->name) }}"
                    class="{{ $errors->has('name') ? 'has-error' : '' }}"
                    maxlength="100"
                    autofocus
                >
                @error('name')
                    <p class="field-error">{{ $message }}</p>
                @else
                    <p class="field-hint">Must be unique. Maximum 100 characters.</p>
                @enderror
            </div>

            {{-- Description --}}
            <div class="form-group">
                <label for="description">Description <span style="color:#bbb; font-weight:400;">Optional</span></label>
                <textarea
                    id="description"
                    name="description"
                    placeholder="A short description of what this category covers…"
                    class="{{ $errors->has('description') ? 'has-error' : '' }}"
                >{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Meta Info --}}
            <div style="padding: 0.875rem 1rem; background: #fafafa; border: 1px solid #efefef;
                        border-radius: 8px; margin-bottom: 1rem; font-size: 0.8rem; color: #888;
                        display: flex; gap: 1.5rem; flex-wrap: wrap;">
                <span>
                    <strong style="color:#555;">Products:</strong>
                    {{ $category->products_count ?? $category->products()->count() }}
                </span>
                <span>
                    <strong style="color:#555;">Created:</strong>
                    {{ $category->created_at->format('M d, Y') }}
                </span>
                <span>
                    <strong style="color:#555;">Last Updated:</strong>
                    {{ $category->updated_at->format('M d, Y') }}
                </span>
            </div>

            {{-- Actions --}}
            <div class="cat-form-actions">
                <button type="submit" class="btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    Save Changes
                </button>
                <a href="{{ route('categories.index') }}" class="btn-secondary">Cancel</a>

                {{-- Danger Zone: Delete (only if no products) --}}
                @can('delete', $category)
                    @if (($category->products_count ?? $category->products()->count()) === 0)
                        <form method="POST" action="{{ route('categories.destroy', $category) }}"
                            style="margin-left: auto;"
                            onsubmit="return confirm('Permanently delete \'{{ addslashes($category->name) }}\'? This cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Delete Category
                            </button>
                        </form>
                    @endif
                @endcan
            </div>
        </form>
    </div>
</x-layout>