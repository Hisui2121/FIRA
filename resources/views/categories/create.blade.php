<x-layout>
    <x-slot name="title">Add Category</x-slot>
 
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/category.css') }}">
    @endpush
 
    {{-- Breadcrumb --}}
    <nav class="cat-breadcrumb">
        <a href="{{ route('categories.index') }}">Categories</a>
        <span class="sep">›</span>
        <span class="current">Add Category</span>
    </nav>
 
    {{-- Page Header --}}
    <div class="cat-header">
        <div class="cat-header__titles">
            <h1>Add Category</h1>
            <p>Create a new category to group your products.</p>
        </div>
    </div>
 
    {{-- Form Card --}}
    <div class="cat-form-card">
        <form method="POST" action="{{ route('categories.store') }}">
            @csrf
 
            {{-- Name --}}
            <div class="form-group">
                <label for="name">Category Name <span style="color:#e74c3c">*</span></label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="e.g. Shoes, Tops, Accessories…"
                    value="{{ old('name') }}"
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
                >{{ old('description') }}</textarea>
                @error('description')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>
 
            {{-- Actions --}}
            <div class="cat-form-actions">
                <button type="submit" class="btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    Save Category
                </button>
                <a href="{{ route('categories.index') }}" class="btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</x-layout>