<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    protected $fillable =[
        'variant_id',
        'type',
        'quantity'
    ];

    // A stock transaction belongs to a variant (the table only has variant_id,
    // there is no product_id column), not directly to a Product.
    public function variant(){
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }
}