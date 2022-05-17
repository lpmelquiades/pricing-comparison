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