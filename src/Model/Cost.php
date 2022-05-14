<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class Cost
{
    private $label;
    private $costItems;

    public function __construct (
        string $label,
        array $costItems
    ) {
        $this->label = $label;
        $this->costItems = $costItems;
    }

    public function calcCost(Order $order): Cost
    {
        
    }
}