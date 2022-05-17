<?php 

declare(strict_types=1);

namespace PricingComparison\UseCases;

use PricingComparison\Model\OrderItems;

final class Compare
{

    private $orderItems;

    public function __construct(OrderItems $orderItems) {
        $this->orderItems = $orderItems;
    }

    public function getOrderItems(): OrderItems
    {
        return $this->orderItems;
    }

}

