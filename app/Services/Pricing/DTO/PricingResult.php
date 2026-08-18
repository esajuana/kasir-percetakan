<?php

namespace App\Services\Pricing\DTO;

class PricingResult
{
    public function __construct(
        public float $unitPrice,
        public float $subtotal,
        public array $breakdown = [],
    ) {
    }
}