<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'width',
        'height',
        'price',
        'effective_from',
        'effective_until',
        'status'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
