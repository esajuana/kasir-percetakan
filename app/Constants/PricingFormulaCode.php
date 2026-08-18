<?php

namespace App\Constants;

class PricingFormulaCode
{
    public const AREA = 'AREA';

    public const ROLL_WIDTH = 'ROLL_WIDTH';

    public const LOOKUP_WIDTH = 'LOOKUP_WIDTH';

    public const PERIMETER = 'PERIMETER';

    public const MANUAL = 'MANUAL';

    /**
     * Return all supported formulas.
     */
    public static function all(): array
    {
        return [
            self::AREA,
            self::ROLL_WIDTH,
            self::LOOKUP_WIDTH,
            self::PERIMETER,
            self::MANUAL,
        ];
    }
}