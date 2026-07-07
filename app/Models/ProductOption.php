<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(
            Category::class
        );
    }

    public function prices()
    {
        return $this->hasMany(ProductPrice::class);
    }
}
