<?php

namespace App\Constants;

class PriceTypeCode
{
    public const NORMAL = 'NORMAL';

    public const SPONSOR = 'SPONSOR';

    public static function all(): array
    {
        return [
            self::NORMAL,
            self::SPONSOR,
        ];
    }
}