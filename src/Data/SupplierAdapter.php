<?php 

declare(strict_types=1);

namespace PricingComparison\Data;

use PricingComparison\Model\Supplier;
use PricingComparison\Model\Offer;
use PricingComparison\Model\Offers;
use PricingComparison\Model\OrderItems;
use PricingComparison\Model\SupplierData;
use PricingComparison\Model\Suppliers;

final class SupplierAdapter implements SupplierData
{

    public function pull(OrderItems $orderItems): Suppliers 
    {
        $a = $this->getSupplierA();
        $b = $this->getSupplierB();

        $suppliers = [];
        if($orderItems->hasProducts($a->getOffers())) {
            $suppliers[] = $a;
        }
        if($orderItems->hasProducts($b->getOffers())) {
            $suppliers[] = $b;
        }

        return new Suppliers($suppliers);
    }

    public function getSupplierA(): Supplier
    {
        return new Supplier(
            'Supplier A', 
            new Offers($this->getOffersSupplierA())
        );
    }

    public function getSupplierB(): Supplier
    {
        return new Supplier(
            'Supplier B', 
            new Offers($this->getOffersSupplierB())
        );
    }

    public function getOffersSupplierA(): array
    {
        return [
            new Offer('Dental Floss', 1, 9.00, 'EUR'),
            new Offer('Dental Floss', 20, 160.00, 'EUR'),
            new Offer('Ibuprofen', 1, 5.00, 'EUR'),
            new Offer('Ibuprofen', 10, 48.00, 'EUR'),
        ]; 
    }

    public function getOffersSupplierB(): array
    {
        return [
            new Offer('Dental Floss', 1, 8.00, 'EUR'),
            new Offer('Dental Floss', 10, 71.00, 'EUR'),
            new Offer('Ibuprofen', 1, 6.00, 'EUR'),
            new Offer('Ibuprofen', 5, 25.00, 'EUR'),
            new Offer('Ibuprofen', 100, 410.00, 'EUR'),
        ]; 
    }
    
}

/**
 * Supplier A
 * Dental Floss 1 Unit 9,00 EUR
 * Dental Floss 20 Units 160,00 EUR
 * Ibuprofen 10 Units 48,00 EUR
 * Ibuprofen 1 Unit 5,00 EUR
 * 
 * Supplier B
 * Dental Floss 1 Unit 8,00 EUR
 * Dental Floss 10 Units 71,00 EUR
 * Ibuprofen 1 Unit 6,00 EUR
 * Ibuprofen 5 Units 25,00 EUR
 * Ibuprofen 100 Units 410,00 EUR
 */