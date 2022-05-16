<?php

declare(strict_types=1);

namespace PricingComparison\Tests\Model;

use PHPUnit\Framework\TestCase;
use PricingComparison\Model\OrderDomainException;
use PricingComparison\Model\Order;
use PricingComparison\Model\OrderItem;

class OrderDomainExceptionTest extends TestCase 
{

    public function testThrowWhenInvalidName()
    {
        $this->expectException(OrderDomainException::class);
        $this->expectExceptionMessage('order_empty_order_items');
        Order::build([], [DataProvider::getOffersSupplierA()]);
    }

    public function testThrowWhenEmptyOffers()
    {
        $this->expectException(OrderDomainException::class);
        $this->expectExceptionMessage('order_empty_suppliers');
        Order::build([new OrderItem('Toothbrush', 20)], []);
    }
   
}