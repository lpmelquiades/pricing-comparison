<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class CostItems
{
    private $set;

    public function __construct(array $entries)
    {
        if(empty($entries)) {
            throw new \InvalidArgumentException('empty_entries');
        }

        if(get_class($entries[0]) !== CostItem::class) {
            throw new \InvalidArgumentException('not_same_class_entries');
        }

        $this->set = new \Ds\Set($entries);   
    }

    public function getCurrency(): string
    {
        return $this->set->get(0)->getCurrency();
    }

    public function getTotalPrice(): float {
        $totalPrice = 0.0;
        foreach ($this->set->toArray() as $costItem) {
            $totalPrice += $costItem->getTotalPrice();
        }
        return $totalPrice;
    }

    public function getResultText(): string
    {
        $text = '';
        foreach ($this->set->toArray() as $costItem) {
            $text .= $costItem->getText() . "\n";
        }
        return $text;
    }
    
}