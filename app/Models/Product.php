<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'code',
        'name',
        'description',
        'calculation_type',
        'minimum_price',
        'rounding_type',
        'allow_finishing',
        'is_package',
        'manage_stock',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function prices()
    {
        return $this->hasMany(ProductPrice::class);
    }

    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    public function stock()
    {
        return $this->hasOne(Stock::class);
    }

    public function options()
    {
        return $this->hasMany(ProductOption::class);
    }
}
