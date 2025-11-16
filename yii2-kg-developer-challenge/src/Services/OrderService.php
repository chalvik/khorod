<?php

declare(strict_types=1);

namespace KGorod\DeveloperChallenge\Services;

use KGorod\DeveloperChallenge\Models\Order;
use KGorod\DeveloperChallenge\Repositories\Interfaces\OrderRepositoryInterface;
use KGorod\DeveloperChallenge\Repositories\Interfaces\OrderItemRepositoryInterface;
use KGorod\DeveloperChallenge\Dto\OrderSummaryDto;
use KGorod\DeveloperChallenge\Dto\OrderListItemDto;
use KGorod\DeveloperChallenge\Dto\OrderTaxDto;

class OrderService
{
    private $orders;
    private $orderItems;

    public function __construct(
        OrderRepositoryInterface $orders,
        OrderItemRepositoryInterface $orderItems
    ) {
        $this->orders = $orders;
        $this->orderItems = $orderItems;
    }

    public function getOrderSummary(int $orderId): ?OrderSummaryDto
    {
        $order = $this->orders->findOrderById($orderId);
        if (!$order) {
            return null;
        }

        $sum = $this->orderItems->getItemsSummary($orderId);

        $dto = new OrderSummaryDto();
        $dto->orderId = $order->id;
        $dto->userId = $order->user_id;
        $dto->createdAt = $order->created_at;
        $dto->totalFromItems = number_format((float) $sum['total_items'], 2, '.', '');
        $dto->totalFromOrders = number_format((float)$order->total, 2, '.', '');
        $dto->itemsCount = $sum['items_count'];
        $dto->priceDiff = number_format($order->total - $sum['total_items'], 2, '.', '');

        return $dto;
    }

    public function listOrdersByUser(int $userId, int $limit = 10): array
    {
        $orders = $this->orders->findOrdersByUser($userId, $limit);
        if (!$orders) {
            return [];
        }

        $ids = array_map(
            function (Order $order) {
                return $order->id;
            },
            $orders
        );
        $countMap = $this->orderItems->getItemsCountForOrders($ids);

        $result = [];

        foreach ($orders as $order) {
            $dto = new OrderListItemDto();
            $dto->orderId = $order->id;
            $dto->userId = $order->user_id;
            $dto->createdAt = $order->created_at;
            $dto->totalFromOrders = number_format((float) $order->total, 2, '.', '');
            $dto->itemsCount = $countMap[$order->id] ?? 0;
            $result[] = $dto;
        }

        return $result;
    }

    public function calculateOrderTaxes(int $orderId, float $taxRate): ?OrderTaxDto
    {
        $order = $this->orders->findOrderById($orderId);
        if (!$order) {
            return null;
        }

        $subtotal = (float)$order->total;
        $taxAmount = round($subtotal * $taxRate, 2);
        $totalWithTax = round($subtotal + $taxAmount, 2);

        $dto = new OrderTaxDto();
        $dto->orderId = $order->id;
        $dto->subtotal = number_format($subtotal, 2, '.', '');
        $dto->taxRate = $taxRate;
        $dto->taxAmount = number_format($taxAmount, 2, '.', '');
        $dto->totalWithTax = number_format($totalWithTax, 2, '.', '');

        return $dto;
    }
}
