<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class OrderItems
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

    public function hasProducts(Offers $offers): bool {
        foreach($this->set->toArray() as $i){
            if(!$offers->hasProduct($i->getProduct())){
                return false;
            }            
        }
        return true;
    }
    
}