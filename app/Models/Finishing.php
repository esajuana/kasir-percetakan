<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Finishing extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'pricing_type',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function variants()
    {
        return $this->hasMany(FinishingVariant::class);
    }

    public function prices()
    {
        return $this->hasMany(FinishingPrice::class);
    }
}
