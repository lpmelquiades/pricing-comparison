<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class Offer implements Buildable, Mapable
{
    use Build;

    private $product;
    private $units;
    private $price;
    private $pricePerUnit;
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
        $this->pricePerUnit = $price/$units;
    }

    public function getKey(): string
    {
        return $this->product;
    }

    public function getUnits(): int
    {
        return $this->units;
    }

    public function getPricePerUnit(): float
    {
        return $this->pricePerUnit;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getCurrency(): string
    {
        return $this->currency; 
    }

    public function getProvision(int $orderUnits): OfferProvisionInterface
    {
        return new OfferProvision($orderUnits, $this->units);
    }
 
}