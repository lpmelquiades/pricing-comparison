<?php

declare(strict_types=1);

namespace PricingComparison\Tests\Model;

use PHPUnit\Framework\TestCase;
use PricingComparison\Model\Order;
use PricingComparison\Model\OrderItem;

class OrderTest extends TestCase 
{

    public function testThrowWhenInvalidName()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('order_empty_order_items');
        Order::build([], [DataProvider::getOffersSupplierA()]);
    }

    public function testThrowWhenEmptyOffers()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('order_empty_suppliers');
        Order::build([new OrderItem('Toothbrush', 20)], []);
    }
   
}