<?php 

declare(strict_types=1);

namespace PricingComparison\UseCases;

use PricingComparison\Data\SupplierAdapter;
use PricingComparison\Log\EchoAdapter;
use PricingComparison\Log\Logger;
use PricingComparison\Model\Order;
use PricingComparison\Model\Data;
use PricingComparison\Model\ResultMessage;
use PricingComparison\Model\SupplierData;

final class CompareHandler
{
    private $suppliers;
    private $logger;

    public function __construct(
        SupplierData $suppliers,
        Logger $logger
    ){
        $this->suppliers = $suppliers;
        $this->logger = $logger;
    }

    public function handle(Compare $compare): ResultMessage
    {
        $o = Order::build(
            $compare->getOrderItems(),
            $this->suppliers->pull($compare->getOrderItems())
        );

        $this->logger->log($o->getResultMessage()->getText());

        return $o->getResultMessage();
    }

    public static function build(): self
    {
        return new static(
            new SupplierAdapter(),
            new EchoAdapter()
        );
    }
}

