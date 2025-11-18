<?php

declare(strict_types=1);

namespace KGorod\DeveloperChallenge\Repositories;

use KGorod\DeveloperChallenge\Models\OrderItem;
use KGorod\DeveloperChallenge\Repositories\Interfaces\OrderItemRepositoryInterface;
use yii\db\Expression;

class OrderItemRepository implements OrderItemRepositoryInterface
{
    /**
     * Сумма позиций заказа + количество
     */
    public function getItemsSummary(int $orderId): array
    {
        $row = OrderItem::find()
            ->where(['order_id' => $orderId])
            ->select([
                'total_items' => new Expression('SUM(quantity * unit_price)'),
                'items_count' => new Expression('COUNT(*)'),
            ])
            ->asArray()
            ->one();

        return [
            'total_items' => $row['total_items'] ?? 0,
            'items_count' => $row['items_count'] ?? 0,
        ];
    }

    /**
     * Количество позиций по группе заказов
     */
    public function getItemsCountForOrders(array $orderIds): array
    {
        if (empty($orderIds)) {
            return [];
        }

        $rows = OrderItem::find()
            ->select([
                'order_id',
                'items_count' => new Expression('COUNT(*)'),
            ])
            ->where(['order_id' => $orderIds])
            ->groupBy(['order_id'])
            ->asArray()
            ->all();

        $map = [];
        foreach ($rows as $row) {
            $map[$row['order_id']] = $row['items_count'];
        }

        return $map;
    }
}
