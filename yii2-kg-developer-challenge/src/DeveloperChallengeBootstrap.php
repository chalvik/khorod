<?php

namespace KGorod\DeveloperChallenge;

use yii\base\Application;
use yii\base\BootstrapInterface;

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
    }
}
