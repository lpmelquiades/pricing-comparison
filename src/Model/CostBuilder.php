<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class CostBuilder implements CostBuilderInterface
{

    public function build(Supplier $supplier, OrderItems $orderItems): Cost {
        // var_dump($supplier);
        // var_dump($orderItems);
        return new Cost(
            $supplier->getName(), 
            $this->buildCostItems($orderItems, $supplier->getOffers())
        );
    }

    private function buildCostItems(OrderItems $orderItems, array $offers): CostItems {
        $costItems = [];

        foreach ($orderItems->toArray() as $orderItem) {
            $offersByProduct = $offers[$orderItem->getProduct()];
            array_push(
                $costItems, 
                ...$this->buildCostItem($orderItem->getUnits(), $offersByProduct)
            );
        }
        return new CostItems($costItems);
    }

    private function buildCostItem(int $remainedUnits, array $offers): array {
        $costItems = [];

        for ($i = 0; $i <= count($offers) && $remainedUnits != 0; $i++) {
            $offer = $offers[$i];

            $costItemBuilder = new CostItemBuilder($remainedUnits, $offer);
        
            if ($costItemBuilder->isBuildAllowed()) {
                $costItems[] =  $costItemBuilder->build();
            }
        
            $remainedUnits = $costItemBuilder->getRemainedUnits();
        }

        return $costItems;
    }   
}