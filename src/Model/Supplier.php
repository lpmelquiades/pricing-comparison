<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

//sera carregado pelo banco
final class Supplier
{
    use BuildMany;

    private $name;
    private $offers;

    private function __construct (
        string $name,
        array $offers,
        OffersBuilder $offersBuilder
    ) { 
        
        if (strlen(trim($name)) < 1) {
            throw new SupplierDomainException('supplier_invalid_name');
        }
        
        if (count($offers) < 1) {
            throw new SupplierDomainException('supplier_empty_offers');
        }

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

    public static function build(string $supplier, array $offers)
    {
        return new static(
            $supplier,
            static::buildMany(Offer::class, $offers),
            new OfferMapBuilder()
        );
    }
    
}