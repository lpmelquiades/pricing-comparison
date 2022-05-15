<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class UnitCalculation
{
    private $orderUnits;
    private $offerUnits;
    private $quantityNeeded;
    private $remainedUnits;
    private $offer;

    public function __construct (
        int $orderUnits,
        int $offerUnits
    ) {
        $this->orderUnits = $orderUnits;
        $this->offerUnits = $offerUnits;
        $this->calcRemainedUnits();
        $this->calcQuantityNeeded();
    }

    private function calcRemainedUnits()
    {
        $this->remainedUnits = $this->orderUnits % $this->offerUnits;
    }

    private function calcQuantityNeeded() {
        $this->quantityNeeded = intval(
            ($this->orderUnits - $this->remainedUnits) / $this->offerUnits
        );
    }

    public function getQuantityNeeded(): int {
        return $this->quantityNeeded;
    }

    public function getRemainedUnits(): int {
        return $this->remainedUnits;
    }

}