<?php 

declare(strict_types=1);

namespace PricingComparison\UseCases;

use PricingComparison\Model\BuildMany;
use PricingComparison\Model\OrderItem;
use PricingComparison\Model\OrderItems;

final class Compare
{
    use BuildMany;

    private $orderItems;

    public function __construct(OrderItems $orderItems) {
        $this->orderItems = $orderItems;
    }

    public function getOrderItems(): OrderItems
    {
        return $this->orderItems;
    }

}

