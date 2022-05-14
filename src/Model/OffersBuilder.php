<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

interface OffersBuilder
{
    public function build(array $offers): array;
}