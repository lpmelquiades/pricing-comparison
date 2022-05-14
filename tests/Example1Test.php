<?php

declare(strict_types=1);

namespace PricingComparison\Tests;

use PHPUnit\Framework\TestCase;
use PricingComparison\Model\Comparison;
use PricingComparison\Model\Result;

class Example1Test extends TestCase 
{
    public function testComparison()
    {
        $c = Comparison::build([
            'orderItems' => $this->getInputOrderData(),
            'suppliers' => DataProvider::getSuppliers()
        ]);


        $expectedResult = new Result('Supplier B', 102.0, 'EUR');
        $this->assertEquals($c->getResult(), $expectedResult);
    }

    public function getInputOrderData(): array
    {
        return [
            [
                'product' => 'Dental Floss',
                'units' => 5
            ],
            [
                'product' => 'Ibuprofen',
                'units' => 12
            ]    
        ];

    }

    public function getExpectedOrderLog(): string
    {
        return "Customer wants to buy 5 Units Dental Floss and 12 Units Ibuprofen.";
    }

    public function getExpectedCostSupplier1Log(): string
    {
        return 
        "
        Cost Supplier A:\n
        5 x 1 Unit Dental Floss - 45 EUR\n
        1 x 10 Units Ibuprofen - 48 EUR\n
        2 x 1 Unit Ibuprofen - 10 EUR\n
        Total: 103 EUR
        ";
    }


    public function getExpectedCostSupplier2Log(): string
    {
        return 
        "
        Cost Supplier B:\n
        5 x 1 Unit Dental Floss - 40 EUR\n
        2 x 5 Units Ibuprofen - 50 EUR\n
        2 x 1 Unit Ibuprofen - 12 EUR\n
        Total: 102 EUR
        ";
    }

    public function getExpectedResultLog(): string
    {
        return "Result: Supplier B is cheaper - 102 EUR";
    }   
}