<?php 

declare(strict_types=1);

namespace PricingComparison\Model\Cost;

use PricingComparison\Model\Offer\Supplier;

interface CostBuilderInterface
{
    public function build(Supplier $supplier, array $orderItems): Cost;
}