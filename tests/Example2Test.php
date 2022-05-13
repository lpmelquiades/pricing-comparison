<?php

use PHPUnit\Framework\TestCase;

class Example2Test extends TestCase 
{
    public function testEmpty()
    {
        $this->assertTrue(false);
    }

    public function getInputOrderData(): array
    {
        return [
            [
                'product' => 'Ibuprofen',
                'units' => 105
            ]    
        ];

    }

    public function getExpectedOrderLog(): string
    {
        return "Customer wants to buy 105 Units Ibuprofen";
    }

    public function getExpectedCostSupplier1Log(): string
    {
        return 
        "
        Cost Supplier A:\n
        10 x 10 Units Ibuprofen - 480 EUR\n
        5 x 1 Unit Ibuprofen - 25 EUR\n
        Total: 505 EUR
        ";
    }


    public function getExpectedCostSupplier2Log(): string
    {
        return 
        "
        Cost Supplier B:\n
        1 x 100 Units Ibuprofen - 410 EUR\n
        1 x 5 Units Ibuprofen - 25 EUR\n
        Total: 435 EUR
        ";
    }

    public function getExpectedResultLog(): string
    {
        return "Result: Supplier B is cheaper - 435 EUR";
    }   
}