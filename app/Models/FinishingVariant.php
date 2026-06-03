<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinishingVariant extends Model
{
    protected $fillable = [
        'finishing_id',
        'name',
        'status'
    ];

    public function finishing()
    {
        return $this->belongsTo(Finishing::class);
    }

    public function prices()
    {
        return $this->hasMany(FinishingPrice::class);
    }
}
