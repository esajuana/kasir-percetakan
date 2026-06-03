<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPackageItem extends Model
{
    protected $fillable = [
        'package_product_id',
        'product_id',
        'qty'
    ];

    public function package()
    {
        return $this->belongsTo(
            Product::class,
            'package_product_id'
        );
    }

    public function product()
    {
        return $this->belongsTo(
            Product::class,
            'product_id'
        );
    }
}
