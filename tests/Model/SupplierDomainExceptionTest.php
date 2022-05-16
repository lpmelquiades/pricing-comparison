<?php

declare(strict_types=1);

namespace PricingComparison\Tests\Model;

use PHPUnit\Framework\TestCase;
use PricingComparison\Model\SupplierDomainException;
use PricingComparison\Model\Supplier;

class SupplierDomainExceptionTest extends TestCase 
{

    public function testDoNotThrowWhenValid()
    {
        $s = Supplier::build(
            'Supplier XYZ', 
            DataProvider::getOffersSupplierA()
        );
        $this->assertInstanceOf(Supplier::class, $s);
    }

    public function testThrowWhenInvalidName()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('supplier_invalid_name');
        Supplier::build('    ', DataProvider::getOffersSupplierA());
    }

    public function testThrowWhenEmptyOffers()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('supplier_empty_offers');
        Supplier::build('Supplier XYZ', []);
    }
   
}