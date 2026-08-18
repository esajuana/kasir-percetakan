<?php

namespace App\Constants;

class PricingParameter
{
    public const MATERIAL_WIDTH = 'material_width';

    public const EXTRA_WIDTH = 'extra_width';

    public const EXTRA_HEIGHT = 'extra_height';

    public const MINIMUM_WIDTH = 'minimum_width';

    public const MINIMUM_HEIGHT = 'minimum_height';

    public const MINIMUM_CHARGE = 'minimum_charge';

    public const MULTIPLE_QTY = 'multiple_qty';

    public const ROUNDING_MODE = 'rounding_mode';

    public const LOOKUP_WIDTH = 'lookup_width';

    public const BLEED = 'bleed';

    public static function all(): array
    {
        return [
            self::MATERIAL_WIDTH,
            self::EXTRA_WIDTH,
            self::EXTRA_HEIGHT,
            self::MINIMUM_WIDTH,
            self::MINIMUM_HEIGHT,
            self::MINIMUM_CHARGE,
            self::MULTIPLE_QTY,
            self::ROUNDING_MODE,
            self::LOOKUP_WIDTH,
            self::BLEED,
        ];
    }
}