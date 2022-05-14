<?php 

declare(strict_types=1);

namespace PricingComparison\Model\Offer;

use PricingComparison\Model\BuildMany;
use PricingComparison\Model\Buildable;

//sera carregado pelo banco
final class Supplier implements Buildable
{
    use BuildMany;

    private $name;
    private $offers;

    private function __construct (
        string $name,
        array $offers,
        OffersBuilder $offersBuilder
    ) { 
        $this->name = $name;
        $this->offers = $offersBuilder->build($offers);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOffers(): array
    {
        return $this->offers;
    }

    //isso aqui vai ir pra um handler
    public static function build(array $entry)
    {
        return new static(
            $entry['supplier'],
            static::buildMany(Offer::class, $entry['offers']),
            new OfferMapBuilder()
        );
    }
    
}