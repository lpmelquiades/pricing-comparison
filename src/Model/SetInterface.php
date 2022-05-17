<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

interface SetInterface
{
    public function __construct(array $entries);

    public function getEntryClass();   
}