<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
      'css/site.css',
      'css/404.css',
      'css/custom.css',
      'css/media.css'
    ];

    public $js = [

    ];

    public $jsOptions = [
        'position' => View::POS_END,
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'frontend\assets\IESupportAsset',
        'frontend\assets\FontAwesomeAsset',
        'frontend\assets\NotyAsset',
        //'frontend\assets\PrintAsset',
    ];
}
