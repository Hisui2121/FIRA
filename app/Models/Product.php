<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'base_price'];

    public function variants()
    {
        return $this->hasMany(ProductVariant::class); 
    }
    public function priceForVariant(ProductVariant $variant)
    {
        return $variant->price_override ?? $this->base_price;
    }

    public function transactions(){
        return $this->hasMany(StockTransaction::class);
    }
}
