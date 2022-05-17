<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class OrderItem implements \Ds\Hashable
{
    private $product;
    private $units;

    public function __construct (
        string $product,
        int $units
    ) {
        $this->product = $product;
        $this->units = $units;
    }

    public function getProduct(): string {
        return $this->product;
    }

    public function getUnits(): int {
        return $this->units;
    }

    public function getResultText(): string {
        return $this->units
        . ' ' . ($this->units === 1 ? 'Unit' : 'Units')
        . ' ' . $this->product;
    }

    public function hash()
    {
        return $this->product;
    }

    public function equals($obj): bool
    {
        if (!is_object($obj)){
            throw new \DomainException('invalid_object');
        } 

        if (get_class($obj) !== static::class){
            throw new \DomainException('invalid_object');
        } 

        if ($obj->hash() !== $this->hash()){
            return false;
        }

        return true;
    }

}