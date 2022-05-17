<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class CostBuilder implements CostBuilderInterface
{

    public function build(Supplier $supplier, OrderItems $orderItems): Cost {
        $builders = $orderItems->getCostItemBuilders($supplier->getOffers());
        return new Cost($supplier->getName(), $builders->build());
    }

}