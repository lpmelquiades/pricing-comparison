<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class Comparison implements Buildable
{
    use BuildEntries;

    private $orderItems;
    private $suppliers;
    private $costs;

    private function __construct (
        array $orderItems,
        array $suppliers
    ) {
        $this->orderItems = $orderItems;
        $this->suppliers = $suppliers;
        // $this->costs = $this->makeCosts($order, $suppliers);
//        $this->result = $this->makeResult();
    }

    public static function build(array $entry)
    {
        return new static(
            static::buildEntries(OrderItem::class, $entry['orderItems']),
            static::buildEntries(Supplier::class, $entry['suppliers'])
        );
    }

    // private function makeCosts (
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