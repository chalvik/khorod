<?php

return [
    'components' => [
        'db'=>[
            'class'=>'yii\db\Connection',
            'dsn' => 'mysql:host=db;dbname=shared',
            'username' => 'root',
            'password' => 'root',
            'tablePrefix' => '',
            'charset' => 'utf8',
        ],
    ],
];