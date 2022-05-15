<?php 

declare(strict_types=1);

namespace PricingComparison\UseCases;

use PricingComparison\Model\BuildMany;
use PricingComparison\Model\OrderItem;

final class Compare
{
    use BuildMany;

    private $orderItems;

    public function __construct(array $payload) {
        $this->orderItems = static::buildMany(OrderItem::class, $payload['order']);
    }

    public function getOrderItems(): array
    {
        return $this->orderItems;
    }

}

