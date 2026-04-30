<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\ProductVariant;
use App\Models\StockTransaction;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'supplier_id',
        'name',
        'sku',
        'price'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

     public function variants()
    {
        return $this->hasMany(ProductVariant::class); 
    }
    public function priceForVariant(ProductVariant $variant)
    {
        return $variant->price_override ?? $this->price;    
    }

    public function transactions(){
        return $this->hasMany(StockTransaction::class);
    }
}
