<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

interface CostBuilderInterface
{
    public function build(Supplier $supplier, array $orderItems): Cost;
}