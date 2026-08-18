<?php

namespace App\Services\Pricing\Support;

use App\Constants\ValueType;
use Illuminate\Support\Collection;

class ParameterResolver
{
    public function resolve(
        Collection $details
    ): array {

        $parameters = [];

        foreach ($details as $detail) {

            $parameters[$detail->parameter] = match ($detail->value_type) {

                ValueType::INTEGER
                    => (int) $detail->value,

                ValueType::DECIMAL
                    => (float) $detail->value,

                ValueType::BOOLEAN
                    => filter_var(
                        $detail->value,
                        FILTER_VALIDATE_BOOLEAN
                    ),

                ValueType::JSON
                    => json_decode(
                        $detail->value,
                        true
                    ),

                default
                    => $detail->value,

            };

        }

        return $parameters;
    }
}