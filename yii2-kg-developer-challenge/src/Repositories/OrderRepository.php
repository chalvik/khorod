<?php

declare(strict_types=1);

namespace KGorod\DeveloperChallenge\Repositories;

use KGorod\DeveloperChallenge\Models\Order;
use KGorod\DeveloperChallenge\Repositories\Interfaces\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    /**
     * Найти заказ по ID
     */
    public function findOrderById(int $orderId): ?Order
    {
        return Order::find()
            ->where(['id' => $orderId])
            ->one();
    }

    /**
     * Заказы пользователя с лимитом
     */
    public function findOrdersByUser(int $userId, int $limit = 10): array
    {
        return Order::find()
            ->where(['user_id' => $userId])
            ->orderBy(['id' => SORT_ASC])
            ->limit($limit)
            ->all();
    }
}
