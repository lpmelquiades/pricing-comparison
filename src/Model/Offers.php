<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class Offers
{
    private $set;
    private $map;

    public function __construct(array $entries)
    {
        if(empty($entries)) {
            throw new \DomainException('empty_entries');
        }
        $this->set = new \Ds\Set($entries); 
        $this->map = $this->buildSortedMap();  
    }

    public function hasOrderItems(OrderItems $ordersItems): bool {
        foreach($ordersItems->toArray() as $i){
            if(!$this->hasProduct($i->getProduct())){
                return false;
            }            
        }
        return true;
    }

    public function getByProduct(string $product): array {
        return $this->map[$product];
    }

    public function hasProduct(string $product): bool {
        return isset($this->map[$product]);
    }

    public function isEmpty(): bool 
    {
        return $this->set->isEmpty();
    }

    public function toArray(): array 
    {
        return $this->set->toArray();
    }

    private function buildMap(): array 
    {
        $map = [];
        foreach ($this->set->toArray() as $i) {
            if(!isset($map[$i->getKey()])) {
                $map[$i->getKey()] = [];
            }
            
            array_push($map[$i->getKey()], $i);
        }
        return $map;
    }

    private function buildSortedMap(): array {
        $map = $this->buildMap();
        foreach ($map as $key => $value) {
            $map[$key] = $this->sort($map[$key]);
        }
        return $map;
    }

    //sort by pricerPerUnit is the right way to find the cheapest supplier
    private function sort(array $offers) {
        usort($offers,
            function (Offer $o, Offer $u): int
            {   
                if ($o->getPricePerUnit() == $u->getPricePerUnit()) {
                    return 0;
                }
                return ($o->getPricePerUnit() < $u->getPricePerUnit()) ? -1 : 1;
            }
        );

        return $offers;
    }
    
}