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

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
