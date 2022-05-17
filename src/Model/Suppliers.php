<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class Suppliers extends Set implements SetInterface 
{
    public function getEntryClass() {
        return Supplier::class;
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