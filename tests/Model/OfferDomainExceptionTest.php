<?php

declare(strict_types=1);

namespace PricingComparison\Tests\Model;

use PHPUnit\Framework\TestCase;
use PricingComparison\Model\Offer;
use PricingComparison\Model\OfferDomainException;

class OfferDomainExceptionTest extends TestCase 
{

    public function testDoNotThrowWhenValid()
    {
        $o = Offer::build(['Toothbrush XYZ', 5, 12.0, 'EUR']);
        $this->assertInstanceOf(Offer::class,$o);
    }

    public function testThrowWhenInvalidProduct()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('offer_invalid_product');
        Offer::build(['   ', 5, 12.0, 'EUR']);
    }

    public function testThrowWhenInvalidCurrency()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('offer_invalid_currency');
        Offer::build(['Toothbrush XYZ', 5, 12.0, 'ABCDE']);
    }

    public function testThrowWhenInvalidUnits()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('offer_invalid_units');
        Offer::build(['Toothbrush XYZ', -7, 12.0, 'EUR']);
    }

    public function testThrowWhenInvalidPrice()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('offer_invalid_price');
        Offer::build(['Toothbrush XYZ', 7, 0.0, 'EUR']);
    }
   
}