<?php

declare(strict_types=1);

namespace KGorod\DeveloperChallenge\Validators;

class OrderTaxValidator
{
    public $order_id;
    public $subtotal;
    public $tax_rate;
    public $tax_amount;
    public $total_with_tax;

    public function rules()
    {
        return [
            [['order_id'], 'integer'],
            [['order_id'], 'required'],

            [['subtotal', 'tax_rate', 'tax_amount', 'total_with_tax'], 'number'],
            [['subtotal', 'tax_rate'], 'required'],

            ['tax_rate', 'number', 'min' => 0, 'max' => 1],

            ['subtotal', 'number', 'min' => 0],
            ['tax_amount', 'number', 'min' => 0],
            ['total_with_tax', 'number', 'min' => 0],
        ];
    }
}