<?php

namespace App\Services\Pricing\Support;

use App\Services\Pricing\DTO\PricingContext;
use Carbon\Carbon;
use RuntimeException;

class TierResolver
{
    public function resolve(
        PricingContext $context,
        Carbon|string|null $date = null
    ): void {

        $date = $date
            ? Carbon::parse($date)
            : now();

        $query = $context
            ->pricingRule
            ->tiers()

            ->where('status', true)

            ->where('qty_min', '<=', $context->qty)

            ->where('qty_max', '>=', $context->qty);

        /*
        |--------------------------------------------------------------------------
        | Effective Date
        |--------------------------------------------------------------------------
        */

        $query

            ->where(function ($q) use ($date) {

                $q

                    ->whereNull('effective_from')

                    ->orWhereDate(
                        'effective_from',
                        '<=',
                        $date
                    );

            })

            ->where(function ($q) use ($date) {

                $q

                    ->whereNull('effective_until')

                    ->orWhereDate(
                        'effective_until',
                        '>=',
                        $date
                    );

            });

        /*
        |--------------------------------------------------------------------------
        | Material Width
        |--------------------------------------------------------------------------
        */

        if ($context->materialWidth !== null) {

            $query

                ->where(function ($q) use ($context) {

                    $q

                        ->whereNull('pricing_rule_detail_id')

                        ->orWhereHas(

                            'pricingRuleDetail',

                            function ($detail) use ($context) {

                                $detail

                                    ->where(

                                        'parameter',

                                        'material_width'

                                    )

                                    ->where(

                                        'value',

                                        $context->materialWidth

                                    );

                            }

                        );

                });

        }

        $tier = $query

            ->orderBy('sort_order')

            ->first();

        if (!$tier) {

            throw new RuntimeException(

                'Pricing tier not found.'

            );

        }

        $context->unitPrice = (float) $tier->price;

        $context->breakdown['tier'] = [

            'tier_id' => $tier->id,

            'qty' => $context->qty,

            'unit_price' => $context->unitPrice,

        ];

    }
}