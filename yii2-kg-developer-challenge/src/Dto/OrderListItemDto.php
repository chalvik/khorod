<?php

declare(strict_types=1);

namespace KGorod\DeveloperChallenge\Dto;

class OrderListItemDto
{
    public $orderId;
    public $userId;
    public $createdAt;
    public $totalFromOrders;
    public $itemsCount;

    public function toArray(): array
    {
        return [
            'order_id' => $this->orderId,
            'user_id' => $this->userId,
            'created_at' => $this->createdAt,
            'total_from_orders' => $this->totalFromOrders,
            'items_count' => $this->itemsCount,
        ];
    }
}

