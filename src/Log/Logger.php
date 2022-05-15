<?php 

declare(strict_types=1);

namespace PricingComparison\Log;

interface Logger
{
    public function log(string $message);
}