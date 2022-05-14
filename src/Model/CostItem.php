<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

//    5 x 1 Unit Dental Floss - 45 EUR
final class CostItem
{
    private $offer;
    private $quantity;

    public function __construct (Offer $label) {
        $this->label = $label;
        $this->costItems = $costItems;
    }

    public function calcCost(Order $order): Cost
    {
        
    }
}