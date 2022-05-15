<?php

declare(strict_types=1);

namespace PricingComparison\Tests;

use PHPUnit\Framework\TestCase;
use PricingComparison\Model\Offer\Supplier;
use PricingComparison\Model\Offer\SupplierDomainException;
use PricingComparison\Tests\DataProvider;

class SupplierDomainExceptionTest extends TestCase 
{

    public function testDoNotThrowWhenValid()
    {
        $s = Supplier::build(
            'Supplier A', 
            DataProvider::getSupplierA()['offers']
        );
        $this->assertInstanceOf(Supplier::class, $s);
    }

    public function testThrowWhenInvalidName()
    {
        $this->expectException(SupplierDomainException::class);
        $this->expectExceptionMessage('supplier_invalid_name');
        Supplier::build('    ', DataProvider::getSupplierA()['offers']);
    }

    public function testThrowWhenEmptyOffers()
    {
        $this->expectException(SupplierDomainException::class);
        $this->expectExceptionMessage('supplier_empty_offers');
        Supplier::build('Supplier Y', []);
    }
   
}