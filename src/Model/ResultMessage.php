<?php 

declare(strict_types=1);

namespace PricingComparison\Model;

final class ResultMessage
{
    private $order;
    private $result;
    private $costs;

    public function __construct (
        string $order,
        string $result,        
        array $costs
    ) {
        $this->order = $order;
        $this->result = $result;
        $this->costs = $costs;
    }

    public function getOrder(): string
    {
        return $this->order;
    }

    public function getResult(): string
    {
        return $this->result;
    }

    public function getCosts(): string
    {
        $text = '';
        foreach($this->costs as $c) {
            $text .= $c . "\n";
        }
        return $text;
    }

    public function getText(): string
    {
        return
        "\n" . $this->order 
        . "\n" . $this->getCosts()
        . "\n" . $this->result . "\n";
    }
}