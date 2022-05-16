<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

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
            throw new \DomainException('supplier_invalid_supplier');
        }
        
        if (count($costItems) < 1) {
            throw new \DomainException('supplier_empty_cost_items');
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

    public function getResultText(): string {
        $text = 'Cost ' . $this->supplier . ":\n";
        foreach ($this->costItems as $costItem) {
            $text .= $costItem->getText() . "\n";
        }
        $text .= 'Total: ' . $this->totalPrice 
        . ' ' .  $this->currency . "\n";
        return $text;
    }
}

/**
 *     Cost Supplier A:
 *     5 x 1 Unit Dental Floss - 45 EUR
 *     1 x 10 Units Ibuprofen - 48 EUR
 *     2 x 1 Unit Ibuprofen - 10 EUR
 *     Total: 103 EUR
 */