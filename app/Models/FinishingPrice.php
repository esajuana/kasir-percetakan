<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinishingPrice extends Model
{
    protected $fillable = [
        'finishing_id',
        'finishing_variant_id',
        'qty_min',
        'qty_max',
        'price',
        'effective_from',
        'effective_until',
        'status'
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
}
