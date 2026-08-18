<?php

namespace App\Services\Pricing\DTO;

use App\Models\PricingRule;

class PricingRequest
{
    public function __construct(

        /**
         * Pricing Rule yang akan digunakan
         */
        public PricingRule $pricingRule,

        /**
         * Jumlah pesanan
         */
        public int $qty,

        /**
         * Lebar yang diinput kasir
         */
        public float $width,

        /**
         * Tinggi yang diinput kasir
         */
        public float $height,

        /**
         * Metadata tambahan
         */
        public array $meta = [],

    ) {
    }
}