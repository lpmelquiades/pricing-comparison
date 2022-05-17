<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class CostItemBuilders implements \Ds\Hashable
{

    private $set;

    public function __construct(array $entries)
    {
        if(empty($entries)) {
            throw new \DomainException('empty_entries');
        }
        
        $this->set = new \Ds\Set($entries);   
    }

}