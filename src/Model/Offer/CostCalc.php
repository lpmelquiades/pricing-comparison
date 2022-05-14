<?php 

declare(strict_types=1);

namespace PricingComparison\Model\Offer;

final class CostCalc implements CostCalcInterface
{

    public function calc(Supplier $supplier, array $orderItems): Cost {
        return new Cost(
            $supplier->getName(), 
            $this->calcCostItems($orderItems, $supplier->getOffers())
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
            $provision = new Provision($remainedUnits, $offer->getUnits());
        
            if ($provision->getQuantityNeeded() > 0) {
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