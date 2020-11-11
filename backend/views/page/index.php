<?php

use core\entities\Page;
use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel backend\forms\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Статичные страницы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <p><?= Html::a('<i class="fa fa-plus-circle"></i> Новая страница', ['create'], ['class' => 'btn btn-success']) ?></p>
    <div class="box">
        <div class="box-body">
            <? \yii\widgets\Pjax::begin() ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'attribute' => 'title',
                        'value' => function (Page $model) {
                            $indent = ($model->depth > 1 ? str_repeat('&nbsp;&nbsp;', $model->depth - 1) . ' ' : '');
                            return $indent . Html::a(Html::encode($model->title), ['view', 'id' => $model->id]);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'value' => function (Page $model) {
                            return
                                Html::a('<span class="glyphicon glyphicon-arrow-up"></span>', ['move-up', 'id' => $model->id]) .
                                Html::a('<span class="glyphicon glyphicon-arrow-down"></span>', ['move-down', 'id' => $model->id]);
                        },
                        'format' => 'raw',
                        'contentOptions' => ['style' => 'text-align: center'],
                    ],
                    'slug',
                    'title',
                    'views',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header'=>'Действия',
                        'headerOptions' => ['width' => '100'],
                        'template' => '{view} {update} {delete} {link}',
                        'buttons' => [
                            'update' => function ($url,$model) {
                                return Html::a(
                                    '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>',
                                    $url,
                                    ['title' => 'Редактировать']);
                            },
                            'link' => function ($url,$model,$key) {
                                return Html::a(
                                    '<i class="fa fa-external-link" aria-hidden="true"></i>',
                                    Yii::$app->params['frontendHostInfo'] . '/' . $model->slug,
                                    ['target' => '_blank', 'title' => 'Посмотреть на сайте']);
                            },
                        ],
                    ],
                ],
            ]); ?>
            <? \yii\widgets\Pjax::end() ?>
        </div>
    </div>
</div>
