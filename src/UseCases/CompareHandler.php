<?php 

declare(strict_types=1);

namespace PricingComparison\UseCases;

use PricingComparison\Log\Logger;
use PricingComparison\Model\Order;
use PricingComparison\Model\Data;
use PricingComparison\Model\ResultMessage;

final class CompareHandler
{
    private $data;
    private $logger;

    public function __construct(
        Data $data,
        Logger $logger
    ){
        $this->data = $data;
        $this->logger = $logger;
    }

    public function handle(Compare $compare): ResultMessage
    {
        $o = Order::build(
            $compare->getOrderItems(),
            $this->data->getSuppliers()
        );

        $this->logger->log($o->getResultMessage()->getText());

        return $o->getResultMessage();
    }
}

