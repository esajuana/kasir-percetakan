<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PricingTier extends Model
{
    protected $fillable = [
        'pricing_rule_id',
        'pricing_rule_detail_id',
        'qty_min',
        'qty_max',
        'price',
        'sort_order',
        'effective_from',
        'effective_until',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'effective_from' => 'date',
        'effective_until' => 'date',
        'status' => 'boolean',
    ];

    public function pricingRule(): BelongsTo
    {
        return $this->belongsTo(
            PricingRule::class
        );
    }

    public function pricingRuleDetail(): BelongsTo
    {
        return $this->belongsTo(
            PricingRuleDetail::class
        );
    }
}