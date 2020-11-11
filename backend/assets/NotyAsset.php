<?php

namespace backend\assets;

use yii\web\AssetBundle;

class NotyAsset extends AssetBundle
{
    public $sourcePath = '@frontend/web/';

    public $css = [
        'plugins/noty/noty.css',
        'plugins/noty/themes/metroui.css',
        'plugins/noty/animate.min.css',
    ];

    public $js = [
        'plugins/noty/noty.min.js',
    ];
}
