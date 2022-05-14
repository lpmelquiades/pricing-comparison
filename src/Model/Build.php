<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

trait Build
{
    public static function build(array $entry) {
        return new self (...array_values($entry));
    }
}