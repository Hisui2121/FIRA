<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;

class StaffDashboardController extends Controller
{
    public function index()
    {
        $products = Product::with('variants')->get();

        $lowStockCount = ProductVariant::where('stock', '<', 10)->count();

        return view('staff.dashboard', compact(
            'products',
            'lowStockCount'
        ));
    }
}