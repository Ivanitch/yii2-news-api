<?php

namespace backend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/kwcount.css',
        'css/aside.css',
        'css/site.css'
    ];


    public $js = [
        'js/kwcount.js',
        'js/aside.js',
        'js/common.js'
    ];

    public $jsOptions = ['position' => View::POS_HEAD];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'backend\assets\FontAwesomeAsset',
        'backend\assets\NotyAsset',
    ];
}