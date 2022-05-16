<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class Costs
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