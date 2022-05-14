<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

interface OfferProvisionInterface
{
    public function getQuantityNeeded(): int;

    public function getRemainedUnits(): int;
}