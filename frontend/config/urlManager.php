<?php

/** @var array $params */

return [
    'class' => 'yii\web\UrlManager',
    'hostInfo' => $params['frontendHostInfo'],
    'enablePrettyUrl' => true,
    'enableStrictParsing' => true,
    'showScriptName' => false,
    'rules' => [
        '' => 'home/index',
        // Signup
        'signup' => 'auth/signup/request',
        'signup-confirm' => 'auth/signup/confirm',
        // Login & Logout
        'login' => 'auth/auth/login',
        'logout' => 'auth/auth/logout',
        // Reset password
        'reset-password' => 'auth/reset/request',
        'confirm-password' => 'auth/reset/confirm',


        // Category
        [
            'pattern' => 'api/category/<slug:[\w\-]+>',
            'route' => 'blog/blog/category'
        ],
        // Post
        [
            'pattern' => 'api/<slug:[\w\-]+>',
            'route' => 'blog/blog/post',
            //'suffix' => '.html',
        ],


        ['pattern' => 'sitemap', 'route' => 'sitemap/index', 'suffix' => '.xml'],
        ['pattern' => 'sitemap-<target:[a-z-]+>-<start:\d+>', 'route' => 'sitemap/<target>', 'suffix' => '.xml'],
        ['pattern' => 'sitemap-<target:[a-z-]+>', 'route' => 'sitemap/<target>', 'suffix' => '.xml'],

        ['class' => 'frontend\urls\PageUrlRule']
    ]
];