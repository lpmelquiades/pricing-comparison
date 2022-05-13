<?php

use PHPUnit\Framework\TestCase;

class DataProvider
{
    public static function getSuppliers(): array
    {
        return [
            self::getSupplierA(),
            self::getSupplierB()
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
                    'amount' => 9.00,
                    'currency' => 'EUR'
                ],
                [ 
                    'product' => 'Dental Floss', 
                    'units' => 20,
                    'amount' => 160.00,
                    'currency' => 'EUR'
                ],
                [ 
                    'product' => 'Ibuprofen', 
                    'units' => 1,
                    'amount' => 5.00,
                    'currency' => 'EUR'
                ],
                [ 
                    'product' => 'Ibuprofen', 
                    'units' => 10,
                    'amount' => 48.00,
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
                    'amount' => 8.00,
                    'currency' => 'EUR'
                ],
                [ 
                    'product' => 'Dental Floss', 
                    'units' => 10,
                    'amount' => 71.00,
                    'currency' => 'EUR'
                ],
                [ 
                    'product' => 'Ibuprofen', 
                    'units' => 1,
                    'amount' => 6.00,
                    'currency' => 'EUR'
                ],
                [ 
                    'product' => 'Ibuprofen', 
                    'units' => 5,
                    'amount' => 25.00,
                    'currency' => 'EUR'
                ],
                [ 
                    'product' => 'Ibuprofen', 
                    'units' => 100,
                    'amount' => 410.00,
                    'currency' => 'EUR'
                ]
            ]
        ];
    }
}