<?php 

declare(strict_types=1);

namespace PricingComparison\Model\Offer;

interface ProvisionInterface
{
    public function getQuantityNeeded(): int;

    public function getRemainedUnits(): int;
}