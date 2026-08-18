<?php

namespace App\Services\Pricing\Support;

use App\Services\Pricing\DTO\PricingContext;

class BusinessRuleResolver
{
    public function resolve(
        PricingContext $context
    ): void {

        $this->applyQtyMultiple($context);

        $this->applyBannerRounding($context);

        $this->applyCanvasBleed($context);

        $this->applyLookupWidth($context);

        $this->applyMinimumCharge($context);
    }

    protected function applyQtyMultiple(
        PricingContext $context
    ): void
    {
    }

    protected function applyBannerRounding(
        PricingContext $context
    ): void
    {
    }

    protected function applyCanvasBleed(
        PricingContext $context
    ): void
    {
    }

    protected function applyLookupWidth(
        PricingContext $context
    ): void
    {
    }

    protected function applyMinimumCharge(
        PricingContext $context
    ): void
    {
    }
}