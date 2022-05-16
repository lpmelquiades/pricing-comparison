<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class Supplier implements \Ds\Hashable
{
    use BuildMany;

    private $name;
    private $offersMap;

    public function __construct (
        string $name,
        Offers $offers
    ) { 

        if (strlen(trim($name)) < 1) {
            throw new \DomainException('supplier_invalid_name');
        }

        $this->name = $name;
        $this->offersMap = $offers->buildSortedMap();
    }

    public function hasOrderItems(OrderItems $ordersItems) {
        foreach($ordersItems->toArray() as $i){
            if(!isset($this->offersMap[$i->getProduct()])){
                return false;
            }            
        }
        return true;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOffersMap(): array
    {
        return $this->offersMap;
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

        if ($obj->hash() !== $this->hash()){
            return false;
        }

        return true;
    }

}