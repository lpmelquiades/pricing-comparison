<?php 

declare(strict_types=1);

namespace PricingComparison\Model\Offer;

//    5 x 1 Unit Dental Floss - 45 EUR
final class CostItem
{
    private $offer;
    private $quantity;
    private $totalPrice;

    public function __construct (Offer $offer, float $quantity) {
        $this->offer = $offer;
        $this->quantity = $quantity;
        $this->totalPrice = $offer->getPrice() * $quantity;
    }

    public function getCurrency(): string
    {
        return $this->offer->getCurrency();
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }
}