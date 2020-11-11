<?php
namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

class IESupportAsset extends AssetBundle
{
    public $js = [
        '//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js',
        '//oss.maxcdn.com/respond/1.4.2/respond.min.js'
    ];

    public $jsOptions = [
        'condition'=>'lt IE 9',
        'position' => View::POS_HEAD,
    ];
}
