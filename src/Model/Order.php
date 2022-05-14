<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

use PricingComparison\Model\Offer\Supplier;
use PricingComparison\Model\Offer\CostCalc;
use PricingComparison\Model\Offer\CostCalcInterface;

final class Order implements Buildable
{
    use BuildMany;

    private $orderItems;
    private $suppliers;
    private $costs;
    private $result;
    private $costCalc;

    private function __construct (
        array $orderItems,
        array $suppliers,
        CostCalcInterface $costCalc
    ) {
        $this->orderItems = $orderItems;
        $this->suppliers = $suppliers;
        $this->costCalc = $costCalc;
        $this->calcResultSteps();
    }

    public function getResult(): Result
    {
        return $this->result;
    }

    public static function build(array $entry)
    {
        return new static(
            static::buildMany(Item::class, $entry['orderItems']),
            static::buildMany(Supplier::class, $entry['suppliers']),
            new CostCalc()
        );
    }

    private function calcResultSteps(){
        $this->calcCosts();
        $this->calcCheapest();
    }

    private function calcCosts() 
    {
        $this->costs = [];
        foreach ($this->suppliers as $supplier) {
            array_push(
                $this->costs, 
                $this->costCalc->calc($supplier, $this->orderItems)
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
}