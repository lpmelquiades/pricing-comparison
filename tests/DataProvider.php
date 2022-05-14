<?php

declare(strict_types=1);

namespace PricingComparison\Tests;

use PHPUnit\Framework\TestCase;

class DataProvider
{
    public static function getSuppliers(): array
    {
        return [
            static::getSupplierA(),
            static::getSupplierB()
        ];
    }

    public static function getSupplierA(): array
    {
        return [
            'supplier' => 'Supplier A',
            'offers' => [
                [ 
                    'product' => 'Dental Floss', 
                    'units' => 1,
                    'price' => 9.00,
                    'currency' => 'EUR'
                ],
                [ 
                    'product' => 'Dental Floss', 
                    'units' => 20,
                    'price' => 160.00,
                    'currency' => 'EUR'
                ],
                [ 
                    'product' => 'Ibuprofen', 
                    'units' => 1,
                    'price' => 5.00,
                    'currency' => 'EUR'
                ],
                [ 
                    'product' => 'Ibuprofen', 
                    'units' => 10,
                    'price' => 48.00,
                    'currency' => 'EUR'
                ]
            ]
        ];
    }

    public static function getSupplierB(): array
    {
        return [
            'supplier' => 'Supplier B',
            'offers' => [
                [ 
                    'product' => 'Dental Floss', 
                    'units' => 1,
                    'price' => 8.00,
                    'currency' => 'EUR'
                ],
                [ 
                    'product' => 'Dental Floss', 
                    'units' => 10,
                    'price' => 71.00,
                    'currency' => 'EUR'
                ],
                [ 
                    'product' => 'Ibuprofen', 
                    'units' => 1,
                    'price' => 6.00,
                    'currency' => 'EUR'
                ],
                [ 
                    'product' => 'Ibuprofen', 
                    'units' => 5,
                    'price' => 25.00,
                    'currency' => 'EUR'
                ],
                [ 
                    'product' => 'Ibuprofen', 
                    'units' => 100,
                    'price' => 410.00,
                    'currency' => 'EUR'
                ]
            ]
        ];
    }
}