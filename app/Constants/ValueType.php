<?php

namespace App\Constants;

class ValueType
{
    public const STRING = 'string';

    public const INTEGER = 'integer';

    public const DECIMAL = 'decimal';

    public const BOOLEAN = 'boolean';

    public const JSON = 'json';

    public static function all(): array
    {
        return [
            self::STRING,
            self::INTEGER,
            self::DECIMAL,
            self::BOOLEAN,
            self::JSON,
        ];
    }
}