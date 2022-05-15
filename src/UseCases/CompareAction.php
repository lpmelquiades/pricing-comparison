<?php 

declare(strict_types=1);

namespace PricingComparison\UseCases;

use PricingComparison\Data\SupplierAdapter;
use PricingComparison\Log\EchoAdapter;
use PricingComparison\Model\ResultMessage;

final class CompareAction
{
    public function make(array $payload): ResultMessage
    {
        $compare = new Compare($payload);
        
        return (new CompareHandler(
            new SupplierAdapter(),
            new EchoAdapter()
        ))->handle($compare);
    }
}

