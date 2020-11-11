<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

class NotyAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'plugins/noty/noty.css',
        'plugins/noty/themes/metroui.css',
        'plugins/noty/animate.min.css',
    ];

    public $js = [
        'plugins/noty/noty.min.js',
    ];

    public $jsOptions = [
        'position' => View::POS_END,
    ];
}
