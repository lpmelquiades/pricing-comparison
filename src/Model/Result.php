<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class Result
{
    private $supplier;
    private $totalPrice;
    private $currency;

    public function __construct (
        string $supplier,        
        float $totalPrice,
        string $currency
    ) {
        $this->supplier = $supplier;
        $this->totalPrice = $totalPrice;
        $this->currency = $currency;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }
}