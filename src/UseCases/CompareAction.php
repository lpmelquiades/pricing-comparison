<?php 

declare(strict_types=1);

namespace PricingComparison\UseCases;

use PricingComparison\Model\ResultMessage;

final class CompareAction
{
    public function make(array $payload): ResultMessage
    {
        $compare = new Compare($payload);
        return CompareHandler::build()->handle($compare);
    }
}

