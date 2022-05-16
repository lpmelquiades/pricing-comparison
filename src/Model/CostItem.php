<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class CostItem implements \Ds\Hashable
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

    public function getText(): string 
    {
        return $this->quantity . ' x '. $this->offer->getText()
        . ' - ' . $this->totalPrice . ' ' . $this->offer->getCurrency();
    }

    public function hash()
    {
        return $this->getText();
    }

    public function equals($obj): bool
    {
        if (is_object($obj) && get_class($obj) === static::class) {
            return true;
        }

        throw new \DomainException('cost_item_invalid_object');
    }
}