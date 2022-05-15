<?php

declare(strict_types=1);

namespace PricingComparison\Tests\UserCases;

use PHPUnit\Framework\TestCase;
use PricingComparison\UseCases\CompareAction;
use PricingComparison\Model\Result;

class Example1Test extends TestCase 
{
    public function testUseCase()
    {
        $resultMessage = (new CompareAction())->make($this->getPayload());        
        $this->assertEquals(
            $resultMessage->getOrder(), 
            $this->getExpectedOrderText()
        );

        $this->assertEquals(
            $resultMessage->getCosts(), 
            $this->getExpectedCostSupplierAText() 
            .  $this->getExpectedCostSupplierBText()
        );

        $this->assertEquals(
            $resultMessage->getResult(),
            $this->getExpectedResultText()
        );
    }

    public function getPayload(): array
    {
        return 
        ['order' => [
            [
                'product' => 'Dental Floss',
                'units' => 5
            ],
            [
                'product' => 'Ibuprofen',
                'units' => 12
            ]    
        ]];

    }

    public function getExpectedOrderText(): string
    {
        return "Customer wants to buy 5 Units Dental Floss and 12 Units Ibuprofen.";
    }

    public function getExpectedCostSupplierAText(): string
    {
        return 
        'Cost Supplier A:' . "\n"
        . '5 x 1 Unit Dental Floss - 45 EUR' . "\n"
        . '1 x 10 Units Ibuprofen - 48 EUR' . "\n"
        . '2 x 1 Unit Ibuprofen - 10 EUR' . "\n"
        . 'Total: 103 EUR' . "\n\n"
        ;
    }


    public function getExpectedCostSupplierBText(): string
    {
        return 
        'Cost Supplier B:' . "\n"
        . '5 x 1 Unit Dental Floss - 40 EUR' . "\n"
        . '2 x 5 Units Ibuprofen - 50 EUR' . "\n"
        . '2 x 1 Unit Ibuprofen - 12 EUR' . "\n"
        . 'Total: 102 EUR' . "\n\n";
    }

    public function getExpectedResultText(): string
    {
        return "Result: Supplier B is cheaper - 102 EUR";
    }   
}