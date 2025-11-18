<?php

declare(strict_types=1);

namespace KGorod\DeveloperChallenge\PublicApi;

use KGorod\DeveloperChallenge\Services\OrderService;
use yii\base\BaseObject;
use Yii;

/**
 * Открытый API модуля Developer Challenge.
 *
 * @author ilya.vikharev
 */
class DeveloperChallengeApi extends BaseObject
{
    private $service;

    public function __construct()
    {
        $this->service = Yii::$container->get(OrderService::class);
        parent::__construct();
    }

    public function getOrderSummary(int $orderId): array
    {
        $dto = $this->service->getOrderSummary($orderId);
        return $dto ? $dto->toArray() : [];
    }

    public function listOrdersByUser(int $userId, int $limit = 10): array
    {
        return array_map(
            function ($dto) {
                return $dto->toArray();
            },
            $this->service->listOrdersByUser($userId, $limit)
        );
    }

    public function calculateOrderTaxes(int $orderId, float $taxRate): array
    {
        $dto = $this->service->calculateOrderTaxes($orderId, $taxRate);
        return $dto ? $dto->toArray() : [];
    }
}