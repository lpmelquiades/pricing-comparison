<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

interface Buildable
{
    public static function build(array $entry);
}