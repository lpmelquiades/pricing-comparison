<?php 

declare(strict_types=1);

namespace PricingComparison\UseCases;

use PricingComparison\Data\SupplierAdapter;
use PricingComparison\Log\EchoAdapter;
use PricingComparison\Model\Order;
use PricingComparison\Model\ResultMessage;
use PricingComparison\Model\SupplierData;

final class CompareHandler
{
    private $supplierData;
    private $logger;

    public function __construct(
        SupplierData $supplierData
    ){
        $this->supplierData = $supplierData;
    }

    public function handle(Compare $compare): ResultMessage
    {
        $o = Order::build(
            $compare->getOrderItems(),
            $this->supplierData->pull($compare->getOrderItems())
        );

        $this->logger->log($o->getResultMessage()->getText());

        return $o->getResultMessage();
    }

    public static function build(): self
    {
        return new static(
            new SupplierAdapter()
        );
    }
}

