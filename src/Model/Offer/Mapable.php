<?php 

declare(strict_types=1);

namespace PricingComparison\Model\Offer;

interface Mapable
{
    public function getKey(): string;
}