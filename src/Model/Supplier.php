<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class Supplier implements \Ds\Hashable
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
            throw new \DomainException('supplier_invalid_name');
        }
        
        if (count($offers) < 1) {
            throw new \DomainException('supplier_empty_offers');
        }

        $this->name = $name;
        $this->offers = $offersBuilder->build($offers);
    }

    public function hasOrderItems(OrderItems $ordersItems) {
        foreach($ordersItems->toArray() as $i){
            if(!isset($this->offers[$i->getProduct()])){
                return false;
            }            
        }
        return true;
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
        return new static($supplier,$offers,new OfferMapBuilder());
    }
    
    public function hash()
    {
        return $this->name;
    }

    public function equals($obj): bool
    {
        if (!is_object($obj)){
            throw new \DomainException('invalid_object');
        } 

        if (get_class($obj) !== static::class){
            throw new \DomainException('invalid_object');
        } 

        return true;
    }

}