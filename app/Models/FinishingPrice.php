<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinishingPrice extends Model
{
    protected $fillable = [
        'finishing_id',
        'finishing_variant_id',
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
        'effective_until' => 'date'
    ];

    public function finishing()
    {
        return $this->belongsTo(Finishing::class);
    }

    public function variant()
    {
        return $this->belongsTo(
            FinishingVariant::class,
            'finishing_variant_id'
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
