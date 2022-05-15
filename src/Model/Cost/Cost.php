<?php 

declare(strict_types=1);

namespace PricingComparison\Model\Cost;

use PricingComparison\Model\Result;

final class Cost
{
    private $supplier;
    private $costItems;
    private $totalPrice;
    private $currency;

    public function __construct (
        string $supplier,
        array $costItems
    ) {
        if (strlen(trim($supplier)) < 1) {
            throw new CostDomainException('supplier_invalid_supplier');
        }
        
        if (count($costItems) < 1) {
            throw new CostDomainException('supplier_empty_cost_items');
        }
        $this->supplier = $supplier;
        $this->costItems = $costItems;
        $this->currency = $costItems[0]->getCurrency();
        $this->totalPrice = 0.0;
        foreach ($costItems as $costItem) {
            $this->totalPrice += $costItem->getTotalPrice();
        }
    }
    
    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function getResult(): Result
    {
        return new Result(
            $this->supplier,
            $this->totalPrice,
            $this->currency
        );
    }
}