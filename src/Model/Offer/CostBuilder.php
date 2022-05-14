<?php 

declare(strict_types=1);

namespace PricingComparison\Model\Offer;

final class CostBuilder implements CostBuilderInterface
{

    public function build(Supplier $supplier, array $orderItems): Cost {
        return new Cost(
            $supplier->getName(), 
            $this->buildCostItems($orderItems, $supplier->getOffers())
        );
    }

    private function buildCostItems(array $orderItems, array $offers): array {
        $costItems = [];

        foreach ($orderItems as $orderItem) {
            $offersByProduct = $offers[$orderItem->getProduct()];
            array_push(
                $costItems, 
                ...$this->buildCostItem($orderItem->getUnits(), $offersByProduct)
            );
        }
        
        return $costItems;
    }

    private function buildCostItem(int $remainedUnits, array $offers): array {
        $costItems = [];

        for ($i = 0; $i <= count($offers) && $remainedUnits != 0; $i++) {
            $offer = $offers[$i];

            $unitCalc = new UnitCalculation($remainedUnits, $offer->getUnits());
        
            if ($unitCalc->getQuantityNeeded() > 0) {
                array_push(
                    $costItems, 
                    new CostItem($offer, $unitCalc->getQuantityNeeded())
                );
            }
        
            $remainedUnits = $unitCalc->getRemainedUnits();
        }

        return $costItems;
    }   
}