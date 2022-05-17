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

    public function calcCosts(OrderItems $orderItems): Costs 
    {
        $costs = [];
        foreach ($this->set->toArray() as $supplier) {
            $builders = $orderItems->getCostItemBuilders($supplier->getOffers());
            $cost = new Cost($supplier->getName(), $builders->build());
            $costs[] = $cost;
        }

        return new Costs($costs);
    }
    
}