<?php

declare(strict_types=1);

namespace KGorod\DeveloperChallenge\Validators;

use yii\base\Model;

class OrderSummaryValidator extends Model
{
    public $order_id;
    public $user_id;
    public $created_at;
    public $total_from_items;
    public $total_from_orders;
    public $items_count;
    public $price_diff;

    public function rules()
    {
        return [
            [['order_id', 'user_id', 'created_at', 'items_count'], 'integer'],
            [['total_from_items', 'total_from_orders', 'price_diff'], 'string'],
        ];
    }
}
