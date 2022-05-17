<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class Offers extends Set implements SetInterface 
{
    public function getEntryClass() {
        return Offer::class;
    }

    private $map;

    public function __construct(array $entries)
    {
        parent::__construct($entries);  
        $this->map = $this->buildSortedMap();  
    }

    //TODO: rework??
    public function getByProduct(string $product): array {
        return $this->map[$product];
    }

    public function hasProduct(string $product): bool {
        return isset($this->map[$product]);
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