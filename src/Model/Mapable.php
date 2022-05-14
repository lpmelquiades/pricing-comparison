<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

interface Mapable
{
    public function getKey(): string;
}