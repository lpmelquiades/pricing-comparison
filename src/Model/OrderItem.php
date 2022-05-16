<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class OrderItem implements Buildable, \Ds\Hashable
{
    use Build;

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
        return $this->name;
    }

    public function equals($obj): bool
    {
        if (is_object($obj) && get_class($obj) === static::class) {
            return true;
        }

        throw new \DomainException('_invalid_object');
    }

}