<?php 

declare(strict_types=1);

namespace PricingComparison\Log;

final class EchoAdapter implements Logger
{
    public function log(string $message){
        echo $message;
    }
}