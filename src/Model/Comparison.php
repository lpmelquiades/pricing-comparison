<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class Comparison implements Buildable
{
    use BuildMany;

    private $orderItems;
    private $suppliers;
    private $costs;

    private function __construct (
        array $orderItems,
        array $suppliers
    ) {
        $this->orderItems = $orderItems;
        $this->suppliers = $suppliers;
        // $this->costs = $this->calcCosts($orderItems, $suppliers);
//        $this->result = $this->makeResult();
    }

    public static function build(array $entry)
    {
        return new static(
            static::buildMany(OrderItem::class, $entry['orderItems']),
            static::buildMany(Supplier::class, $entry['suppliers'])
        );
    }

    // private function calcCosts (
    //     array $orderItems,
    //     array $suppliers
    // ): array {
    //     $costs = [];
    //     foreach ($suppliers as $supplier) {
    //         array_push($costs, $supplier->calcCost($orderItems));
    //     }
    //     return $costs;
    // }
}