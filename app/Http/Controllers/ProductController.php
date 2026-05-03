<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Support\Str;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductController extends Controller
{
    use AuthorizesRequests;
    
    public function index(Request $request)
    {

        $query = Product::with(['category', 'supplier', 'variants']);

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('supplier_id')) {
            $query->where('supplier_id', $request->supplier_id);
        }

        $products = $query->get();

        return view('products.index', [
            'products' => $products,
            'totalProducts' => Product::count(),
            'totalSuppliers' => Supplier::count(),
            'totalCategories' => Category::count(),
            'lowStockCount' => ProductVariant::where('stock', '<', 10)->count(),
            'categories' => Category::all(),
            'suppliers' => Supplier::all(),
        ]);
    }

    public function create()
    {
        $this->authorize('create', Product::class);

        return view('products.create', [
            'categories' => Category::all(),
            'suppliers' => Supplier::all(),
        ]);

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'sku' => 'required|unique:products',
            'price' => 'required|numeric',
            'variants.*.size' => 'required',
            'variants.*.color' => 'required',
            'variants.*.stock' => 'required|integer|min:0',
        ]);

        // Cproduct
        $product = Product::create([
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'name' => $request->name,
            'sku' => strtoupper(Str::slug($request->name)) . '-' . rand(100,999),
            'price' => $request->price,
        ]);

        if ($request->new_category) {
            $category = Category::firstOrCreate([
                'name' => $request->new_category
            ]);
        
            $category_id = $category->id;
        }

        // for variants save
        if ($request->has('variants')) {
            foreach ($request->variants as $variant) {

                $base = strtoupper(Str::slug($request->name, '-'));
                $color = strtoupper(substr($variant['color'], 0, 3));
                $size = strtoupper($variant['size']);
                $unique = rand(100, 999);
        
                $sku = $base . '-' . $color . '-' . $size . '-' . $unique;

                $product->variants()->create([
                    'size' => $variant['size'],
                    'color' => $variant['color'],
                    'stock' => $variant['stock'],
                    'price_override' => $variant['price_override'] ?? null,
                    'sku' => $sku,
                ]);
            }
        }
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'created product',
            'product_name' => $product->name,
        ]);

        return redirect()->route('products.index')->with('success', 'Product Added!');
    }

    public function edit($id)
    {
        
        $product = Product::with('variants')->findOrFail($id);
        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $this->authorize('update', $product);
    
        $request->validate([
            'name' => 'required',
            'sku' => 'required|unique:products,sku,' . $id,
            'price' => 'required|numeric',
        ]);
    
        $product->update($request->only([
            'category_id',
            'supplier_id',
            'name',
            'sku',
            'price'
        ]));
    
        return redirect()->route('products.index')->with('success', 'Product updated!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $this->authorize('delete', $product);
    
        $product->delete();
    
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'deleted product',
            'product_name' => $product->name,
        ]);
    
        return redirect()->route('products.index')->with('success', 'Product deleted!');
    }

    //  variant 
    public function storeVariant(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'size' => 'required',
            'color' => 'required',
            'stock' => 'required|integer|min:0',
        ]);

        ProductVariant::create([
            'product_id' => $request->product_id,
            'size' => $request->size,
            'color' => $request->color,
            'stock' => $request->stock,
            'price_override' => $request->price_override,
        ]);

        return back()->with('success', 'Variant added!');
    }

    //  Stock In
    public function stockIn(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $variant = ProductVariant::findOrFail($id);
    
        $this->authorize('stock', $variant);
    
        $variant->increment('stock', $request->quantity);
    
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'stock_in',
            'product_name' => $variant->product->name,
            'quantity' => $request->quantity,
        ]);
    
        return back()->with('success', 'Stock added!');
    }

    // Stock Out
    public function stockOut(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $variant = ProductVariant::findOrFail($id);
    
        $this->authorize('stock', $variant);
    
        $variant->decrement('stock', $request->quantity);
    
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'stock_out',
            'product_name' => $variant->product->name,
            'quantity' => $request->quantity,
        ]);
   
        return back()->with('success', 'Stock deducted!');

    }
}