<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Helpers\AuditHelper;

class CategoryController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $this->authorize('viewAny', Category::class);

        $query = Category::withCount('products');

        // SEARCH (by name or description)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // SORT
        $sort = $request->get('sort', 'name');
        $direction = $request->get('direction', 'asc');

        $allowedSorts = ['name', 'created_at', 'products_count'];
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'name';
        }
        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'asc';
        }

        $query->orderBy($sort, $direction);

        $categories = $query->paginate(10)->withQueryString();

        return view('categories.index', [
            'categories' => $categories,
            'search'     => $request->search,
            'sort'       => $sort,
            'direction'  => $direction,
        ]);
    }

    public function create()
    {
        $this->authorize('create', Category::class);

        return view('categories.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Category::class);

        $request->validate([
            'name'        => 'required|string|max:100|unique:categories,name',
            'description' => 'nullable|string',
        ], [
            'name.unique' => 'A category with this name already exists.',
        ]);

        $category = Category::create([
            'name'        => $request->name,
            'description' => $request->description,
        ]);

        AuditHelper::log(
            'CREATE',
            'Categories',
            'Added category: ' . $category->name
        );

        return redirect()->route('categories.index')->with('success', 'Category added!');
    }

    public function edit(Category $category)
    {
        $this->authorize('update', $category);

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $this->authorize('update', $category);

        $request->validate([
            'name'        => 'required|string|max:100|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ], [
            'name.unique' => 'A category with this name already exists.',
        ]);

        $category->update([
            'name'        => $request->name,
            'description' => $request->description,
        ]);

        AuditHelper::log(
            'UPDATE',
            'Categories',
            'Updated category: ' . $category->name
        );

        return redirect()->route('categories.index')->with('success', 'Category updated!');
    }

    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);

        // Guard: don't allow deleting a category that still has products
        if ($category->products()->exists()) {
            return back()->with('error', 'Cannot delete "' . $category->name . '" — it still has products assigned to it. Reassign or remove those products first.');
        }

        $name = $category->name;
        $category->delete();

        AuditHelper::log(
            'DELETE',
            'Categories',
            'Deleted category: ' . $name
        );

        return back()->with('success', 'Category deleted.');
    }
}