<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PricingRule extends Model
{
    protected $fillable = [
        'ruleable_type',
        'ruleable_id',
        'pricing_formula_id',
        'price_type_id',
        'name',
        'priority',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function ruleable(): MorphTo
    {
        return $this->morphTo();
    }

    public function formula(): BelongsTo
    {
        return $this->belongsTo(
            PricingFormula::class,
            'pricing_formula_id'
        );
    }

    public function priceType(): BelongsTo
    {
        return $this->belongsTo(
            PriceType::class
        );
    }

    public function details(): HasMany
    {
        return $this->hasMany(
            PricingRuleDetail::class
        );
    }

    public function tiers(): HasMany
    {
        return $this->hasMany(
            PricingTier::class
        );
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}