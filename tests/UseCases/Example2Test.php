<?php

declare(strict_types=1);

namespace PricingComparison\Tests\UserCases;

use PHPUnit\Framework\TestCase;
use PricingComparison\Model\Result;
use PricingComparison\UseCases\CompareAction;

class Example2Test extends TestCase 
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
                'product' => 'Ibuprofen',
                'units' => 105
            ]    
        ]];

    }

    public function getExpectedOrderText(): string
    {
        return "Customer wants to buy 105 Units Ibuprofen.";
    }

    public function getExpectedCostSupplierAText(): string
    {
        return 
        'Cost Supplier A:' . "\n"
        . '10 x 10 Units Ibuprofen - 480 EUR' . "\n"
        . '5 x 1 Unit Ibuprofen - 25 EUR' . "\n"
        . 'Total: 505 EUR' . "\n\n";
    }


    public function getExpectedCostSupplierBText(): string
    {
        return 
        'Cost Supplier B:' . "\n"
        . '1 x 100 Units Ibuprofen - 410 EUR' . "\n"
        . '1 x 5 Units Ibuprofen - 25 EUR' . "\n"
        . 'Total: 435 EUR' . "\n\n";
    }

    public function getExpectedResultText(): string
    {
        return "Result: Supplier B is cheaper - 435 EUR";
    }   
}