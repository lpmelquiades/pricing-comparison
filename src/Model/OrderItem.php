<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class OrderItem implements Buildable
{
    use Build;

    private $product;
    private $units;

    private function __construct (
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

}