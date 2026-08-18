<?php

namespace App\Services\Pricing\Contracts;

use App\Services\Pricing\DTO\PricingContext;
use App\Services\Pricing\DTO\PricingResult;

interface PricingFormulaInterface
{
    public function calculate(
        PricingContext $context
    ): PricingResult;
}