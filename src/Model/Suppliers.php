<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class Suppliers
{
    use BuildMany;

    private $set;

    public function __construct(array $entries)
    {
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
    
}