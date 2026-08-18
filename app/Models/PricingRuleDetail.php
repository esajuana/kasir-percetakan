<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PricingRuleDetail extends Model
{
    protected $fillable = [
        'pricing_rule_id',
        'parameter',
        'value',
        'value_type',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function pricingRule(): BelongsTo
    {
        return $this->belongsTo(
            PricingRule::class
        );
    }

    public function tiers(): HasMany
    {
        return $this->hasMany(
            PricingTier::class
        );
    }
}