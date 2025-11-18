<?php

namespace unit;

use KGorod\DeveloperChallenge\Services\OrderService;
use KGorod\DeveloperChallenge\Repositories\Interfaces\OrderRepositoryInterface;
use KGorod\DeveloperChallenge\Repositories\Interfaces\OrderItemRepositoryInterface;
use KGorod\DeveloperChallenge\Models\Order;

class OrderServiceTest extends \Codeception\Test\Unit
{
    public function testGetOrderSummary()
    {
        $orderRepo = $this->createMock(OrderRepositoryInterface::class);
        $itemRepo  = $this->createMock(OrderItemRepositoryInterface::class);

        $order = new Order();
        $order->id = 1;
        $order->user_id = 10;
        $order->created_at = 1000;
        $order->total = 200.00;

        $orderRepo->method('findOrderById')->willReturn($order);

        $itemRepo->method('getItemsSummary')->willReturn([
            'total_items' => 150.00,
            'items_count' => 3
        ]);

        $service = new OrderService($orderRepo, $itemRepo);

        $dto = $service->getOrderSummary(1);

        $this->assertEquals(1, $dto->orderId);
        $this->assertEquals('50.00', $dto->priceDiff);
    }
}
