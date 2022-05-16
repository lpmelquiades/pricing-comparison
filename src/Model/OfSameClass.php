<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

trait OfSameClass
{
    public static function ofSameClass($class, array $entries): bool 
    {
        if(empty($entries)) {
            return false;
        }

        $same =  array_reduce($entries, function ($same, $i) use ($class) {
            return $same && is_object($i) && get_class($i) === $class;
        }, true);

        return $same;
    }
}