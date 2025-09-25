<?php

return [
    'components' => [
        'db'=>[
            'class'=>'yii\db\Connection',
            'dsn' => 'mysql:host=db;dbname=shared',
            'username' => 'root',
            'password' => 'root',
            'tablePrefix' => '',
    //        'dsn' => env('DB_DSN'),
    //        'username' => env('DB_USERNAME'),
    //        'password' => env('DB_PASSWORD'),
    //        'tablePrefix' => env('DB_TABLE_PREFIX'),
            'charset' => 'utf8',
        ],
    ],
];