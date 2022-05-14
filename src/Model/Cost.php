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