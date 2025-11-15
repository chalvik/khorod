<?php

declare(strict_types=1);

namespace KGorod\DeveloperChallenge\Repositories\Interfaces;

interface OrderItemRepositoryInterface
{
    public function getItemsSummary(int $orderId): array;
    public function getItemsCountForOrders(array $orderIds): array;
}
