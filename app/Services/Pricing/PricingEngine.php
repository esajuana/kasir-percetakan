<?php

namespace App\Services\Pricing;

use App\Services\Pricing\DTO\PricingContext;
use App\Services\Pricing\DTO\PricingRequest;
use App\Services\Pricing\DTO\PricingResult;
use App\Services\Pricing\Factory\PricingFormulaFactory;
use App\Services\Pricing\Support\BusinessRuleResolver;
use App\Services\Pricing\Support\DimensionResolver;
use App\Services\Pricing\Support\ParameterResolver;
use App\Services\Pricing\Support\TierResolver;

class PricingEngine
{
    public function __construct(

        protected ParameterResolver $parameterResolver,

        protected BusinessRuleResolver $businessRuleResolver,

        protected DimensionResolver $dimensionResolver,

        protected TierResolver $tierResolver,

    ) {
    }

    public function calculate(
        PricingRequest $request
    ): PricingResult {

        /*
        |--------------------------------------------------------------------------
        | Load Pricing Rule
        |--------------------------------------------------------------------------
        */

        $pricingRule = $request
            ->pricingRule
            ->loadMissing([

                'formula',

                'details',

                'tiers',

            ]);

        /*
        |--------------------------------------------------------------------------
        | Resolve Parameters
        |--------------------------------------------------------------------------
        */

        $parameters = $this
            ->parameterResolver
            ->resolve(
                $pricingRule->details
            );

        /*
        |--------------------------------------------------------------------------
        | Build Context
        |--------------------------------------------------------------------------
        */

    $context = new PricingContext(

        pricingRule: $pricingRule,

        originalQty: $request->qty,

        originalWidth: $request->width,

        originalHeight: $request->height,

        qty: $request->qty,

        width: $request->width,

        height: $request->height,

        parameters: $parameters,

        meta: $request->meta,

    );

        /*
        |--------------------------------------------------------------------------
        | Business Rules
        |--------------------------------------------------------------------------
        */

        $this
            ->businessRuleResolver
            ->resolve($context);

        /*
        |--------------------------------------------------------------------------
        | Dimension
        |--------------------------------------------------------------------------
        */

        $this
            ->dimensionResolver
            ->resolve($context);

        /*
        |--------------------------------------------------------------------------
        | Tier
        |--------------------------------------------------------------------------
        */

        $this
            ->tierResolver
            ->resolve($context);

        /*
        |--------------------------------------------------------------------------
        | Formula
        |--------------------------------------------------------------------------
        */

        $formula = PricingFormulaFactory::make(

            $pricingRule
                ->formula
                ->code

        );

        /*
        |--------------------------------------------------------------------------
        | Calculate
        |--------------------------------------------------------------------------
        */

        return $formula
            ->calculate($context);

    }
}