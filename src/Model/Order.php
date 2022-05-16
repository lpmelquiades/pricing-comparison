<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class Order
{
    use BuildMany;

    private $orderItems;
    private $suppliers;
    private $costs;
    private $result;
    private $costBuilder;
    private $resultMessage;

    private function __construct (
        array $orderItems,
        array $suppliers,
        CostBuilderInterface $costBuilder
    ) {
        if (count($orderItems) < 1) {
            throw new \DomainException('order_empty_order_items');
        }

        if (count($suppliers) < 1) {
            throw new \DomainException('order_empty_suppliers');
        }

        $this->orderItems = $orderItems;
        $this->suppliers = $suppliers;
        $this->costBuilder = $costBuilder;
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

    public static function build(array $orderItems, array $suppliers)
    {
        return new static($orderItems,$suppliers, new CostBuilder());
    }

    private function calcResultSteps(){
        $this->calcCosts();
        $this->calcCheapest();
        $this->makeResultMessage();
    }

    private function calcCosts() 
    {
        $this->costs = [];
        foreach ($this->suppliers as $supplier) {
            array_push(
                $this->costs, 
                $this->costBuilder->build($supplier, $this->orderItems)
            );
        }
    }

    private function calcCheapest()
    {
        $cheapest = $this->costs[0];
        foreach ($this->costs as $cost) {
            if ($cheapest->getTotalPrice() > $cost->getTotalPrice()) {
                $cheapest = $cost;
            }
        }

        $this->result = $cheapest->getResult();
    } 

    private function makeResultMessage() {
        $this->resultMessage = new ResultMessage(
            $this->getOrderItemsResultText(),
            $this->getResultText(),
            $this->getCostsResultText()
        );
    }

    private function getOrderItemsResultText(): string {
        $text = '';
        foreach ($this->orderItems as $i) {
            $text .= $i->getResultText() . ' and ';
        } 
        $text .= 'end';
        $text = str_replace(' and end', '.', $text);
        return 'Customer wants to buy ' . $text;
    }

    private function getResultText(): string {
        return 'Result: ' 
        . $this->result->getSupplier() 
        . ' is cheaper - ' . $this->result->getTotalPrice() 
        . ' ' . $this->result->getCurrency(); 
    }

    private function getCostsResultText(): array {
        $costs = [];
        foreach ($this->costs as $cost){
            $costs[] = $cost->getResultText();
        }
        return $costs;
    }

}

/**  
 * Example 1
 * Customer wants to buy 5 Units Dental Floss and 12 Units Ibuprofen.
 * 
 *     Cost Supplier A:
 *     5 x 1 Unit Dental Floss - 45 EUR
 *     1 x 10 Units Ibuprofen - 48 EUR
 *     2 x 1 Unit Ibuprofen - 10 EUR
 *     Total: 103 EUR
* 
*     Cost Supplier B:
*     5 x 1 Unit Dental Floss - 40 EUR
*     2 x 5 Units Ibuprofen - 50 EUR
*     2 x 1 Unit Ibuprofen - 12 EUR
*     Total: 102 EUR
*     
*     Result: Supplier B is cheaper - 102 EUR
* 
* Example 2
* Customer wants to buy 105 Units Ibuprofen
* 
*     Cost Supplier A:
*     10 x 10 Units Ibuprofen - 480 EUR
*     5 x 1 Unit Ibuprofen - 25 EUR
*     Total: 505 EUR
* 
*     Cost Supplier B:
*     1 x 100 Units Ibuprofen - 410 EUR
*     1 x 5 Units Ibuprofen - 25 EUR
*     Total: 435 EUR
* 
*     Result: Supplier B is cheaper - 435 EUR
*/