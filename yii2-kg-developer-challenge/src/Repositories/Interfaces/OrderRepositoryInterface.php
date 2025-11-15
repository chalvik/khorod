<?php

declare(strict_types=1);

namespace KGorod\DeveloperChallenge\Repositories\Interfaces;

use KGorod\DeveloperChallenge\Models\Order;

interface OrderRepositoryInterface
{
    public function findOrderById(int $orderId): ?Order;
    public function findOrdersByUser(int $userId, int $limit = 10): array;
}
