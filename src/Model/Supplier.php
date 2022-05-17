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
            throw new \InvalidArgumentException('invalid_name');
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
            throw new \InvalidArgumentException('invalid_object');
        } 

        if (get_class($obj) !== static::class){
            throw new \InvalidArgumentException('invalid_class');
        } 

        if ($obj->hash() !== $this->hash()){
            return false;
        }

        return true;
    }

}