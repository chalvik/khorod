<?php

declare(strict_types=1);

namespace KGorod\DeveloperChallenge\Dto;

class OrderTaxDto
{
    public $orderId;
    public $subtotal;
    public $taxRate;
    public $taxAmount;
    public $totalWithTax;

    public function toArray(): array
    {
        return [
            'order_id' => $this->orderId,
            'subtotal' => $this->subtotal,
            'tax_rate' => $this->taxRate,
            'tax_amount' => $this->taxAmount,
            'total_with_tax' => $this->totalWithTax,
        ];
    }
}
