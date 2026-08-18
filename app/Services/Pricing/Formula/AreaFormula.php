<?php

namespace App\Services\Pricing\Formula;

use App\Services\Pricing\Contracts\PricingFormulaInterface;
use App\Services\Pricing\DTO\PricingContext;
use App\Services\Pricing\DTO\PricingResult;

class AreaFormula implements PricingFormulaInterface
{
    public function calculate(
        PricingContext $context
    ): PricingResult {

        $area = $context->width * $context->height;

        $subtotal = ($area * $context->unitPrice)
            + $context->additionalCharge;

        $context->subtotal = $subtotal;

        $context->breakdown['formula'] = [

            'formula' => 'AREA',

            'width' => $context->width,

            'height' => $context->height,

            'area' => $area,

            'unit_price' => $context->unitPrice,

            'additional_charge' => $context->additionalCharge,

            'subtotal' => $subtotal,

        ];

        return new PricingResult(

            unitPrice: $context->unitPrice,

            subtotal: $subtotal,

            breakdown: $context->breakdown,

        );
    }
}