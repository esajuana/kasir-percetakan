<?php

namespace App\Services\Pricing\Support;

use App\Constants\PricingParameter;
use App\Services\Pricing\DTO\PricingContext;

class DimensionResolver
{
    public function resolve(
        PricingContext $context
    ): void {

        /*
        |--------------------------------------------------------------------------
        | Round To
        |--------------------------------------------------------------------------
        */

        $roundTo = $context->parameters[
            PricingParameter::ROUND_TO
        ] ?? null;

        if ($roundTo) {

            $context->width =
                ceil($context->width / $roundTo) * $roundTo;

            $context->height =
                ceil($context->height / $roundTo) * $roundTo;

        }

        /*
        |--------------------------------------------------------------------------
        | Material Width
        |--------------------------------------------------------------------------
        */

        $materialWidths = $context->parameters[
            PricingParameter::MATERIAL_WIDTH
        ] ?? [];

        if (!empty($materialWidths)) {

            sort($materialWidths);

            foreach ($materialWidths as $roll) {

                if ($context->width <= $roll) {

                    $context->materialWidth = $roll;

                    break;

                }

            }

            if (!$context->materialWidth) {

                $context->materialWidth = max($materialWidths);

            }

        }

        /*
        |--------------------------------------------------------------------------
        | Material Height
        |--------------------------------------------------------------------------
        */

        $context->materialHeight = $context->height;

        /*
        |--------------------------------------------------------------------------
        | Breakdown
        |--------------------------------------------------------------------------
        */

        $context->breakdown['dimension'] = [

            'width' => $context->width,

            'height' => $context->height,

            'material_width' => $context->materialWidth,

            'material_height' => $context->materialHeight,

        ];

    }
}