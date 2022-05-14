<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class Comparison implements Buildable
{
    use BuildMany;

    private $orderItems;
    private $suppliers;
    private $costs;
    private $result;

    private function __construct (
        array $orderItems,
        array $suppliers
    ) {
        $this->orderItems = $orderItems;
        $this->suppliers = $suppliers;
        $this->calcResultSteps();
    }

    public function getResult(): Result
    {
        return $this->result;
    }

    public static function build(array $entry)
    {
        return new static(
            static::buildMany(OrderItem::class, $entry['orderItems']),
            static::buildMany(Supplier::class, $entry['suppliers'])
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
            array_push($this->costs, $supplier->calcCost($this->orderItems));
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