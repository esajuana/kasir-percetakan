<?php

namespace App\Services\Pricing\Factory;

use App\Constants\PricingFormulaCode;
use App\Services\Pricing\Contracts\PricingFormulaInterface;
use App\Services\Pricing\Formula\AreaFormula;
use App\Services\Pricing\Formula\LookupWidthFormula;
use App\Services\Pricing\Formula\ManualFormula;
use App\Services\Pricing\Formula\PerimeterFormula;
use App\Services\Pricing\Formula\RollWidthFormula;
use InvalidArgumentException;

class PricingFormulaFactory
{
    public static function make(
        string $formulaCode
    ): PricingFormulaInterface
    {
        return match ($formulaCode) {

            PricingFormulaCode::AREA
                => new AreaFormula(),

            PricingFormulaCode::ROLL_WIDTH
                => new RollWidthFormula(),

            PricingFormulaCode::LOOKUP_WIDTH
                => new LookupWidthFormula(),

            PricingFormulaCode::PERIMETER
                => new PerimeterFormula(),

            PricingFormulaCode::MANUAL
                => new ManualFormula(),

            default => throw new InvalidArgumentException(
                "Unsupported pricing formula [{$formulaCode}]"
            ),

        };
    }
}