<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class Supplier implements \Ds\Hashable
{

    private $name;
    private $offers;

    public function __construct (
        string $name,
        Offers $offers
    ) { 

        if (strlen(trim($name)) < 1) {
            throw new \InvalidArgumentException('not_same_class_entries');
        }

        $this->name = $name;
        $this->offers = $offers;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOffers(): Offers
    {
        return $this->offers;
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