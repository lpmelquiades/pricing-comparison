<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

//sera carregado pelo banco
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

    public function calcCost(array $orderItems): Cost {
        $costItems = [];
        foreach ($orderItems as $orderItem) {
            array_push($costItems, ...$this->calcCostItems($orderItem));
        }
        return new Cost($this->name, $costItems);
    }

    public function calcCostItems(OrderItem $orderItem): array {
        $remainedUnits = $orderItem->getUnits();
        $offers = $this->offers[$orderItem->getProduct()];
        $costItems = [];
        
        for ($i = 0; $i <= count($offers) && $remainedUnits != 0; $i++) {
            $r = $remainedUnits % $offers[$i]->getUnits();
            $offerQuantity = ($remainedUnits-$r)/$offers[$i]->getUnits();
            if ($offerQuantity > 0 ){
                array_push($costItems, new CostItem($offers[$i], $offerQuantity));
            }
            $remainedUnits = $r;
        }
        return $costItems;
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