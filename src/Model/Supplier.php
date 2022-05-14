<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class Supplier implements Buildable
{
    use BuildMany;

    private $name;
    private $offers;

    private function __construct (
        string $name,
        array $offers
    ) { 
        $this->name = $name;
        $this->offers = $this->sortMap($this->buildMap($offers));
    }

    private function sortMap(array $map) {
        foreach ($map as $key => $value) {
            $map[$key] = $this->sortDesc($map[$key]);
        }
        return $map;
    }

    private function sortDesc(array $offers) {
        usort($offers,
            function (Offer $o, Offer $u): int
            {   
                if ($o->getUnits() == $u->getUnits()) {
                    return 0;
                }
                return ($o->getUnits() < $u->getUnits()) ? 1 : -1;
            }
        );

        return $offers;
    }

    public function calcCost(array $orderItems): Cost {
        $costItems = [];
        foreach ($orderItems as $i) {
            
        }
    }

    //isso aqui vai ir pra um handler
    public static function build(array $entry)
    {
        return new static(
            $entry['supplier'],
            static::buildMany(Offer::class, $entry['offers'])
        );
    }

    private function buildMap(array $instances): array 
    {
        $map = [];
        foreach ($instances as $i) {
            if(!isset($map[$i->getKey()])) {
                $map[$i->getKey()] = [];
            }
            
            array_push($map[$i->getKey()], $i);
        }
        return $map;
    }
    
}