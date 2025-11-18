<?php

declare(strict_types=1);

namespace KGorod\DeveloperChallenge\Validators;

class OrderListItemValidator
{
    public $order_id;
    public $user_id;
    public $created_at;
    public $total_from_orders;
    public $items_count;

    public function rules()
    {
        return [
            [['order_id', 'user_id', 'created_at', 'items_count'], 'integer'],
            [['order_id', 'user_id', 'created_at'], 'required'],

            ['items_count', 'integer', 'min' => 0],

            ['total_from_orders', 'number'],
            ['total_from_orders', 'required'],
        ];
    }
}