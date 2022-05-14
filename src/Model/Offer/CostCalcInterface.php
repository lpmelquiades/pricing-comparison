<?php 

declare(strict_types=1);

namespace PricingComparison\Model\Offer;

interface CostCalcInterface
{
    public function calc(Supplier $supplier, array $orderItems): Cost;
}