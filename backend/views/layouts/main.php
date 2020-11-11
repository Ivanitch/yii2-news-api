<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
AppAsset::register($this);
?>
<? if (Yii::$app->user->can('admin')): ?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <?php
        NavBar::begin(
            [
                'options' => [
                    'class' => 'navbar navbar-inverse',
                    'id' => 'main-menu'
                ],
                'renderInnerContainer' => true,
                'innerContainerOptions' => [
                    'class' => 'container-fluid'
                ],
                'brandLabel' => 'Site name',
                'brandUrl' => ['/site/index'],
                'brandOptions' => ['class' => 'navbar-brand']
            ]
        );

        $menuItems = [
            [
                'label' => 'Навигация <i class="fa fa-list"></i>',
                'items' => [
                    '<li class="dropdown-header">Пользователи</li>',
                    '<li class="divider"></li>',
                    [
                        'label' => 'Список пользователей',
                        'url' => ['/user/index']
                    ]
                ]
            ],
            [
                'label' => 'Информация <i class="fa fa-info-circle"></i>',
                'url' => [
                    '#'
                ],
                'linkOptions' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'style' => 'cursor: pointer; outline: none;'
                ],
            ],
        ];
        $menuItems[] = [
            'label' => 'Выйти <i class="fa fa-sign-out"></i>',
            'url' => ['/auth/logout'],
            'linkOptions' => [
                'data-method' => 'post'
            ],
        ];
        $menuItems[] = [
            'label' => 'На сайт <i class="fa fa-globe"></i>',
            'url' => Yii::$app->params['frontendHostInfo'],
            'linkOptions' => [
                'target' => '_blank'
            ],
        ];

        echo Nav::widget([
            'items' => $menuItems,
            'activateParents' => true,
            'encodeLabels' => false,
            'options' => [
                'class' => 'navbar-nav navbar-right'
            ]
        ]);

        Modal::begin([
            'header' => '<h2>Yii2 starter template</h2>',
            'id' => 'modal'
        ]);
        echo 'Стартовый шаблон сайта на Yii2 Framework Advanced';
        Modal::end();
        NavBar::end(); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <?= $this->render('//common/aside') ?>
            </div>
            <div class="col-md-10">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= $content ?>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container-fluid">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>
<? \common\components\Noty::run() ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<? else: ?>
    <?
    Yii::$app->session->setFlash('error', 'Access is denied!');
    return Yii::$app->getResponse()->redirect(Url::to(['/auth/login']));

    ?>
<? endif; ?>