<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class Offer implements Mapable, \Ds\Hashable
{
    private $product;
    private $units;
    private $price;
    private $pricePerUnit;
    private $currency;

    public function __construct (
        string $product,
        int $units,
        float $price,
        string $currency
    ) {

        if (strlen(trim($product)) < 1) {
            throw new \InvalidArgumentException('invalid_product');
        }

        if (strlen(trim($currency)) !== 3) {
            throw new \InvalidArgumentException('invalid_currency');            
        }

        if ($units < 1) {
            throw new \InvalidArgumentException('invalid_units');
        }

        if ($price <= 0.0) {
            throw new \InvalidArgumentException('invalid_price');
        }

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

    public function getProduct(): string
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

    public function getText(): string
    {
        return $this->units
        . ' ' . ($this->units === 1 ? 'Unit' : 'Units') 
        . ' ' . $this->product;
    }

    public function hash()
    {
        return $this->getText();
    }

    public function equals($obj): bool
    {
        if (!is_object($obj)){
            throw new \InvalidArgumentException('invalid_object');
        } 

        if (get_class($obj) !== static::class){
            throw new \InvalidArgumentException('invalid_class');
        } 

        if ($obj->hash() !== $this->hash()){
            return false;
        }

        return true;
    }
    
}