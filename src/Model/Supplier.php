<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

//sera carregado pelo banco
final class Supplier implements Buildable
{
    use BuildMany;

    private $name;
    private $offers;
    private $costCalc;

    private function __construct (
        string $name,
        array $offers,
        OffersBuilder $offersBuilder,
        CostCalcInterface $costCalc
    ) { 
        $this->name = $name;
        $this->offers = $offersBuilder->build($offers);
        $this->costCalc = $costCalc;
    }

    public function calcCost(array $orderItems): Cost {
        return $this->costCalc->calc($this->name, $orderItems, $this->offers);
    }

    //isso aqui vai ir pra um handler
    public static function build(array $entry)
    {
        return new static(
            $entry['supplier'],
            static::buildMany(Offer::class, $entry['offers']),
            new OfferMapBuilder(),
            new CostCalc()
        );
    }
    
}