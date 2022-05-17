<?php 

declare(strict_types=1);

namespace PricingComparison\Model;


final class CostItemBuilder implements \Ds\Hashable
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
            throw new \DomainException(
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

    public function isAllowed(): bool 
    {
        return $this->quantityNeeded > 0;
    }

    public function build(): CostItem
    {
        if($this->isAllowed()){
            return new CostItem($this->offer, $this->getQuantityNeeded());
        }

        throw new \DomainException(
            'cost_item_builder_build_not_allowed'
        );
    }

    public function hash()
    {
        return $this->orderUnits 
        . ' ' . $this->offer->getText()
        . ' ' . $this->quantityNeeded
        . ' ' . $this->remainedUnits;
    }

    public function equals($obj): bool
    {
        if (!is_object($obj)){
            throw new \DomainException('invalid_object');
        } 

        if (get_class($obj) !== static::class){
            throw new \DomainException('invalid_object');
        } 

        if ($obj->hash() !== $this->hash()){
            return false;
        }

        return true;
    }

}