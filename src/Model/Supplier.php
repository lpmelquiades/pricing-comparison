<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class Supplier implements Buildable
{
    use BuildEntries;

    private $name;
    private $offers;

    private function __construct (
        string $name,
        array $offers
    ) {
        $this->name = $name;
        $this->offers = $offers;
    }

    public static function build(array $entry)
    {
        return new static(
            $entry['supplier'], 
            static::buildEntries(Offer::class, $entry['offers'])
        );
    }
    
}