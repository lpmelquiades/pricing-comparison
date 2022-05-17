<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class Costs extends Set implements SetInterface 
{
    public function getEntryClass() {
        return Cost::class;
    }

    public function getResultText(): array {
        $costs = [];
        foreach ($this->set->toArray() as $cost){
            $costs[] = $cost->getResultText();
        }
        return $costs;
    }

    public function calcCheapest(): Cost
    {
        $cheapest = $this->set->get(0);
        foreach ($this->set->toArray() as $cost) {
            if ($cheapest->getTotalPrice() > $cost->getTotalPrice()) {
                $cheapest = $cost;
            }
        }

        return $cheapest;
    }
    
}