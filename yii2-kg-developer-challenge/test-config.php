<?php
use yii\helpers\ArrayHelper;

$vendorPath = __DIR__ . '/vendor';

$localConfig = require __DIR__ . '/test-config-local.php';

$config =  [
    'vendorPath' => $vendorPath,
    'id' => 'basic-tests',
    'basePath' => dirname(__DIR__),
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'bootstrap' => ['gii'],
    'language' => 'en-US',
    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'useTablePrefix' => true,
            'migrationPath' => [
            ],
            'migrationNamespaces' => [
                'KGorod\\DeveloperChallenge\\Migrations',
            ],
        ],
    ],
    'modules' => [
       'gii' => [
            'class' => 'yii\gii\Module',
        ],
    ],
];
    
return ArrayHelper::merge($config, $localConfig);
