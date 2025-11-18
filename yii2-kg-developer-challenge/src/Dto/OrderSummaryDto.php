<?php

declare(strict_types=1);

namespace KGorod\DeveloperChallenge\Dto;

class OrderSummaryDto
{
    public $orderId;
    public $userId;
    public $createdAt;

    public $totalFromItems;
    public $totalFromOrders;
    public $itemsCount;
    public $priceDiff;

    public function toArray(): array
    {
        return [
            'order_id' => $this->orderId,
            'user_id' => $this->userId,
            'created_at' => $this->createdAt,
            'total_from_items' => $this->totalFromItems,
            'total_from_orders' => $this->totalFromOrders,
            'items_count' => $this->itemsCount,
            'price_diff' => $this->priceDiff,
        ];
    }
}
