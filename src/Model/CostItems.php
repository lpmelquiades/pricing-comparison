<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class CostItems extends Set implements SetInterface 
{
    public function getEntryClass() {
        return CostItem::class;
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