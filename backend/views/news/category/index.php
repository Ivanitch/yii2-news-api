<?php

use core\entities\News\Category;
use yii\helpers\Html;
use yii\grid\GridView;
use \yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\News\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<p>
    <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
</p>
<? Pjax::begin() ?>
    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        [
            'attribute' => 'name',
            'value' => function (Category $model) {
                $indent = ($model->depth > 1 ? str_repeat('&nbsp;&nbsp;', $model->depth - 1) . ' ' : '');
                return $indent . Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
            },
            'format' => 'raw',
        ],
        [
            'value' => function (Category $model) {
                return
                    Html::a('<span class="glyphicon glyphicon-arrow-up"></span>', ['move-up', 'id' => $model->id]) .
                    Html::a('<span class="glyphicon glyphicon-arrow-down"></span>', ['move-down', 'id' => $model->id]);
            },
            'format' => 'raw',
            'contentOptions' => ['style' => 'text-align: center'],
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header'=>'Действия',
            'headerOptions' => ['width' => '140'],
            'template' => '{view} {update} {delete} {link}',
            'buttons' => [
                'view' => function ($url,$model) {
                    return Html::a(
                        '<i class="fa fa-eye" aria-hidden="true"></i>',
                        $url,
                        ['title' => 'Просмотр']);
                },
                'update' => function ($url,$model) {
                    return Html::a(
                        '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>',
                        $url,
                        ['title' => 'Редактировать']);
                },
                'link' => function ($url,Category $model,$key) {
                    return Html::a(
                        '<i class="fa fa-external-link" aria-hidden="true"></i>',
                        Yii::$app->params['frontendHostInfo'] . '/category/'.$model->id,
                        ['target' => '_blank', 'title' => 'Посмотреть на сайте']);
                },
            ],
        ],
    ],
]); ?>
<? Pjax::end() ?>

