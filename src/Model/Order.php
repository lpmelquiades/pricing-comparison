<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class Order
{
    private $orderItems;
    private $suppliers;
    private $costs;
    private $result;
    private $resultMessage;

    private function __construct (
        OrderItems $orderItems,
        Suppliers $suppliers
    ) {
        
        $this->orderItems = $orderItems;
        $this->suppliers = $suppliers;
        $this->calcResultSteps();
    }

    public function getResult(): Result
    {
        return $this->result;
    }

    public function getResultMessage(): ResultMessage
    {
        return $this->resultMessage;
    }

    public static function build(OrderItems $orderItems, Suppliers $suppliers)
    {
        return new static($orderItems, $suppliers);
    }

    private function calcResultSteps(){
        $this->calcCosts();
        $this->calcCheapest();
        $this->makeResultMessage();
    }

    private function calcCosts() 
    {
        $this->costs = $this->suppliers->calcCosts($this->orderItems);
    }

    private function calcCheapest()
    {
        $this->result = $this->costs->calcCheapest()->getResult();
    } 

    private function makeResultMessage() {
        $this->resultMessage = new ResultMessage(
            $this->orderItems->getResultText(),
            $this->result->getResultText(),
            $this->costs->getResultText()
        );
    }
}
