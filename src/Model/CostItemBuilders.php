<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class CostItemBuilders
{

    private $set;

    public function __construct(array $entries)
    {
        if(empty($entries)) {
            throw new \DomainException('empty_entries');
        }

        $this->set = new \Ds\Set($entries);   
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