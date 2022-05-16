<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

interface SupplierData
{
    public function pull(array $orderItems): Suppliers;
}