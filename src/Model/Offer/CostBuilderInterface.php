<?php 

declare(strict_types=1);

namespace PricingComparison\Model\Offer;

interface CostBuilderInterface
{
    public function build(Supplier $supplier, array $orderItems): Cost;
}