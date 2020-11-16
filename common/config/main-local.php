<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            #'dsn' => 'mysql:host=82.146.63.173;port=3310;dbname=db_name',
            #'username' => 'username',
            #'password' => 'password',
            'dsn' => 'mysql:host=localhost;port=3306;dbname=yii2-news',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8mb4',
            //'tablePrefix' => 'prefix_',
            'enableSchemaCache' => false,
            'schemaCacheDuration' => 3600 * 24 * 30 * 12,
            'schemaCache' => 'cache',
            'schemaMap' => [
                'mysql' => [
                    'class' => 'yii\db\mysql\Schema',
                    'columnSchemaClass' => [
                        'class' => 'yii\db\mysql\ColumnSchema',
                        'disableJsonSupport' => true,
                    ]
                ]
            ]
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => '',
                'username' => '',
                'password' => '',
                'port' => '465',
                'encryption' => 'ssl',
            ],
            'messageConfig' => [
                'from' => ['' => 'Site name']
            ],
            'useFileTransport' => false,
        ]
    ],
];
