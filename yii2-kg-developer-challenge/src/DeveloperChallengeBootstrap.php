<?php

namespace KGorod\DeveloperChallenge;

use KGorod\DeveloperChallenge\Repositories\Interfaces\OrderItemRepositoryInterface;
use KGorod\DeveloperChallenge\Repositories\Interfaces\OrderRepositoryInterface;
use KGorod\DeveloperChallenge\Repositories\OrderItemRepository;
use KGorod\DeveloperChallenge\Repositories\OrderRepository;
use yii\base\Application;
use yii\base\BootstrapInterface;
use Yii;
/**
 * Класс инициализации для модуля Developer Challenge.
 */
class DeveloperChallengeBootstrap implements BootstrapInterface
{
    /**
     * {@inheritdoc}
     * 
     * @param Application $app
     */
    public function bootstrap($app)
    {
        $app->controllerMap['migrate']['migrationNamespaces'][] = 'KGorod\\DeveloperChallenge\\Migrations';

        Yii::$container->set(OrderRepositoryInterface::class, OrderRepository::class);
        Yii::$container->set(OrderItemRepositoryInterface::class, OrderItemRepository::class);
    }
}
