<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class OrderItems extends Set implements SetInterface 
{
    public function getEntryClass() {
        return OrderItem::class;
    }

    public function hasProducts(Offers $offers): bool {
        foreach($this->set->toArray() as $i){
            if(!$offers->hasProduct($i->getProduct())){
                return false;
            }            
        }
        return true;
    }

    public function getResultText(): string {
        $text = '';
        foreach ($this->set->toArray() as $i) {
            $text .= $i->getResultText() . ' and ';
        } 
        $text .= 'end';
        $text = str_replace(' and end', '.', $text);
        return 'Customer wants to buy ' . $text;
    }

    public function getCostItemBuilders(Offers $offers): CostItemBuilders {
        $builders = [];
        foreach ($this->set->toArray() as $orderItem) {
            $offersByProduct = $offers->getByProduct($orderItem->getProduct());
            $buildersByShare = $this->getCostItemBuildersByShare(
                $orderItem->getUnits(), 
                $offersByProduct
            );
            array_push($builders, ...$buildersByShare);
        }
        return new CostItemBuilders($builders);
    }


    private function getCostItemBuildersByShare(
        int $remainedUnits, 
        array $offers
    ): array {
        $builders = [];
        for ($i = 0; $i <= count($offers) && $remainedUnits != 0; $i++) {
            $offer = $offers[$i];
            $builder = new CostItemBuilder($remainedUnits, $offer);
            $builders[] = $builder;
            $remainedUnits = $builder->getRemainedUnits();
        }
        return $builders;
    }   
    
}