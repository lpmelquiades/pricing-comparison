<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

//sera carregado pelo banco
final class CostCalc implements CostCalcInterface
{

    public function calc(
        string $supplier, 
        array $orderItems, 
        array $offers
    ): Cost {
        return new Cost(
            $supplier, 
            $this->calcCostItems($orderItems, $offers)
        );
    }

    private function calcCostItems(array $orderItems, array $offers): array {
        $costItems = [];

        foreach ($orderItems as $orderItem) {
            $offersByProduct = $offers[$orderItem->getProduct()];
            array_push(
                $costItems, 
                ...$this->calcCostItem($orderItem->getUnits(), $offersByProduct)
            );
        }
        
        return $costItems;
    }

    private function calcCostItem(int $remainedUnits, array $offers): array {
        $costItems = [];

        for ($i = 0; $i <= count($offers) && $remainedUnits != 0; $i++) {
            $offer = $offers[$i];

            $provision = $offer->getProvision($remainedUnits);
        
            if ($provision->getQuantityNeeded() > 0){
                array_push(
                    $costItems, 
                    new CostItem($offer, $provision->getQuantityNeeded())
                );
            }
        
            $remainedUnits = $provision->getRemainedUnits();
        }

        return $costItems;
    }
    
}