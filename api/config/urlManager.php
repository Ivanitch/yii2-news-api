<?php
/** @var array $params */
return [
    'class' => 'yii\web\UrlManager',
    'enablePrettyUrl' => true,
    'enableStrictParsing' => true,
    'showScriptName' => false,
    'rules' => [
        'POST auth' => 'site/login',
        'GET profile' => 'profile/index',

        //=== Category
        'POST category' => 'category/create',
        'PUT category/<id:\d+>' => 'category/update',
        'DELETE category/<id:\d+>' => 'category/delete',
        'category/page=<page:\d+>' => 'category/index',
        'category' => 'category/index',
        'category/<id:\d+>' => 'category/view',

        //=== News
        [
            'pluralize' => false,
            'class' => 'yii\rest\UrlRule',
            'controller' => 'news'
        ],
        'news/<id:\d+>/activate' => 'news/activate',
    ],
];