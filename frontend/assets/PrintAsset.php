<?php

namespace frontend\assets;
use yii\web\AssetBundle;

class PrintAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/print.css',
    ];

    public $cssOptions = [
        'rel' => 'stylesheet',
        'media' => 'print'
    ];
}