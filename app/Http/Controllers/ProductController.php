<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('variants')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $products = Product::all();
        return view('products.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'base_price'=>'required|numeric|min:0',
            'description'=>'nullable|string',
        ]);

        $product = Product::create([
            'name'=>$request->name,
            'base_price'=>$request->base_price,
            'desciption'=>$request->description,
        ]);

        // if($request->has('variant_size')&&$request->variant_size != ''){
        //     $product->variants()->create([
        //         'size'=>$request->variant_size,
        //         'color'=>$request->variant_color ?? 'Default',
        //         'stock'=>$request->variant_stock ?? 0,
        //         'price_override'=>$request->variant_price ?? null,
        //     ]);
        // }

        return redirect()->route('products.index')->with('sucess', 'Product Added!');
    }

    public function storeVariant(Request $request)
    {
        $request->validate([
            'product_id' =>'required',
            'size'=>'required',
            'color'=>'required',
            'stock'=>'required|integer|min:0',
        ]);
        ProductVariant::create([
            'product_id'=>$request->product_id,
            'size'=>$request->size,
            'color'=>$request->color,
            'stock'=>$request->stock,
            'price_override'=>$request->price_override,
        ]);
        return redirect('/products');
    }

    public function sortVariant(Request $request)
    {
        ProductVariant::sort([
            'size'=>$request->size,
        ]);
    }

    public function stockIn(Request $request, $id)
    {
        $variant=ProductVariant::findOrFail($id);
        $variant->stock += $request->quantity;
        $variant->save();
        return redirect()->back();
    }
    
    public function stockOut(Request $request, $id)
    {  
        $variant=ProductVariant::findOrFail($id);
        if($variant->stock >= $request->quantity){
            $variant->stock -= $request->quantity;
            $variant->save();
            return redirect()->back();
        }
    }
}
