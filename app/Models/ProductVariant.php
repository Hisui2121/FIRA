<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductVariant extends Model
{
    protected $fillable = ['product_id', 'size', 'color', 'stock', 'price_override'];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function actualPrice(){
        return $this->price_override ?? $this->product->base_price;
    }
}
