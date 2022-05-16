<?php 

declare(strict_types=1);

namespace PricingComparison\Model;


final class CostItemBuilder
{
    private $orderUnits;
    private $offer;
    private $quantityNeeded;
    private $remainedUnits;

    public function __construct (
        int $orderUnits,
        Offer $offer
    ) {

        if ($orderUnits < 1) {
            throw new CostItemBuilderDomainException(
                'cost_item_builder_invalid_order_units'
            );
        }

        $this->orderUnits = $orderUnits;
        $this->offer = $offer;
        $this->calcRemainedUnits();
        $this->calcQuantityNeeded();
    }

    private function calcRemainedUnits()
    {
        $this->remainedUnits = $this->orderUnits % $this->offer->getUnits();
    }

    private function calcQuantityNeeded() {
        $this->quantityNeeded = intval(
            ($this->orderUnits - $this->remainedUnits) / $this->offer->getUnits()
        );
    }

    public function getQuantityNeeded(): int {
        return $this->quantityNeeded;
    }

    public function getRemainedUnits(): int {
        return $this->remainedUnits;
    }

    public function isBuildAllowed(): bool 
    {
        return $this->quantityNeeded > 0;
    }

    public function build(): CostItem
    {
        if($this->isBuildAllowed()){
            return new CostItem($this->offer, $this->getQuantityNeeded());
        }

        throw new CostItemBuilderDomainException(
            'cost_item_builder_build_not_allowed'
        );
    }

}