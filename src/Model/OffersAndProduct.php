<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class OffersAndProduct
{
    private $offers;
    private $product;

    public function __construct (
        string $product,
        Offers $offers
    ) {
        $this->offers = $offers;
        $this->$product;
    }

}