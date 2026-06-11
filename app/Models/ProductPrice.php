<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    protected $fillable = [
        'product_id',
        'product_variant_id',
        'product_option_id',
        'price_type',
        'qty_min',
        'qty_max',
        'price',
        'effective_from',
        'effective_until',
        'status'
    ];

    protected $casts = [
        'effective_from' => 'date',
        'effective_until' => 'date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variant()
    {
        return $this->belongsTo(
            ProductVariant::class,
            'product_variant_id'
        );
    }

    public function option()
    {
        return $this->belongsTo(
            ProductOption::class,
            'product_option_id'
        );
    }

    public function scopeNormal($query)
    {
        return $query->where(
            'price_type',
            'normal'
        );
    }

    public function scopeSponsor($query)
    {
        return $query->where(
            'price_type',
            'sponsor'
        );
    }
}
