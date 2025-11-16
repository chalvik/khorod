<?php

use KGorod\DeveloperChallenge\Repositories\Interfaces\OrderItemRepositoryInterface;
use KGorod\DeveloperChallenge\Repositories\Interfaces\OrderRepositoryInterface;
use KGorod\DeveloperChallenge\Repositories\OrderItemRepository;
use KGorod\DeveloperChallenge\Repositories\OrderRepository;

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

defined('YII_APP_BASE_PATH') or define('YII_APP_BASE_PATH', dirname(dirname(__DIR__)));

require_once(YII_APP_BASE_PATH . '/vendor/autoload.php');
require_once(YII_APP_BASE_PATH . '/vendor/yiisoft/yii2/Yii.php');

Yii::setAlias('@tests', dirname(dirname(__DIR__)));
Yii::setAlias('@KGorod/DeveloperChallenge', dirname(dirname(__DIR__)));

Yii::$container->set(OrderRepositoryInterface::class, OrderRepository::class);
Yii::$container->set(OrderItemRepositoryInterface::class, OrderItemRepository::class);
