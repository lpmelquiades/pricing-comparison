<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class CostItemBuilders extends Set implements SetInterface 
{
    public function getEntryClass() {
        return CostItemBuilder::class;
    }

    public function build(): CostItems
    {
        $costItems = [];
        foreach ($this->set->toArray() as $builder ) {
            if ($builder->isAllowed()) {
                $costItems[] = $builder->build();
            }
        }
        return new CostItems($costItems);
    }
}