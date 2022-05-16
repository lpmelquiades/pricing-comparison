<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class Suppliers
{

    private $set;

    public function __construct(array $entries)
    {
        if(empty($entries)) {
            throw new \DomainException('empty_entries');
        }
        $this->set = new \Ds\Set($entries);   
    }

    public function isEmpty(): bool 
    {
        return $this->set->isEmpty();
    }

    public function toArray(): array 
    {
        return $this->set->toArray();
    }

    public function calcCosts(CostBuilder $costBuilder, $orderItems): Costs 
    {
        $costs = [];
        foreach ($this->set->toArray() as $supplier) {
            $cost = $costBuilder->build(
                $supplier, $orderItems
            );
            $costs[] = $cost;
        }

        return new Costs($costs);
    }
    
}