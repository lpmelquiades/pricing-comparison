<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

abstract class Set implements SetInterface
{
    protected $set;

    public function __construct(array $entries)
    {
        if(empty($entries)) {
            throw new \InvalidArgumentException('empty_entries');
        }

        if(get_class($entries[0]) !== $this->getEntryClass()) {
            throw new \InvalidArgumentException('invalid_class');
        }

        $this->set = new \Ds\Set($entries);   
    }

    abstract public function getEntryClass();
    
}