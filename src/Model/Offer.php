<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class Offer implements Buildable
{
    use Build;

    private $product;
    private $units;
    private $price;
    private $currency;

    private function __construct (
        string $product,
        int $units,
        float $price,
        string $currency
    ) {
        $this->product = $product;
        $this->units = $units;
        $this->price = $price;
        $this->currency = $currency;
    }
    
}