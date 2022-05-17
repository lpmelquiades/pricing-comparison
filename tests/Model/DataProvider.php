<?php

declare(strict_types=1);

namespace PricingComparison\Tests\Model;

use PricingComparison\Model\Offer;
use PricingComparison\Model\Supplier;
use PricingComparison\Model\Suppliers;

class DataProvider
{
    public static function getSuppliers(): Suppliers
    {
        return new Suppliers(
            [static::getSupplierA(), static::getOffersSupplierB()]
        );
    }
 
    public static function getOffersSupplierA(): array
    {
        return [
            new Offer('Dental Floss', 1, 9.00, 'EUR'),
            new Offer('Dental Floss', 20, 160.00, 'EUR'),
            new Offer('Ibuprofen', 1, 5.00, 'EUR'),
            new Offer('Ibuprofen', 10, 48.00, 'EUR'),
        ]; 
    }

    public static function getOffersSupplierB(): array
    {
        return [
            new Offer('Dental Floss', 1, 8.00, 'EUR'),
            new Offer('Dental Floss', 10, 71.00, 'EUR'),
            new Offer('Ibuprofen', 1, 6.00, 'EUR'),
            new Offer('Ibuprofen', 5, 25.00, 'EUR'),
            new Offer('Ibuprofen', 100, 410.00, 'EUR'),
        ]; 
    }

    public static function getSupplierA(): Supplier
    {
        return Supplier::build('Supplier A', static::getOffersSupplierA());
    }

    public static function getSupplierB(): Supplier
    {
        return Supplier::build('Supplier B', static::getOffersSupplierB());
    }

}