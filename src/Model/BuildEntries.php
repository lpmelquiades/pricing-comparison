<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

trait BuildEntries
{
    private static function buildEntries($class, array $entries): array {
        $instances = [];
        foreach ($entries as $e) {
            array_push($instances, $class::build($e));
        }
        return $instances;
    }
}