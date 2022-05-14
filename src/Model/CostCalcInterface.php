<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

interface CostCalcInterface
{
    public function calc(string $supplier, array $orderItems, array $offers): Cost;
}