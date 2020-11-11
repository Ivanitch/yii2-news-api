<?php

use core\entities\News\News;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use \yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel \backend\forms\News\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'All news';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <p>
        <?= Html::a('Create News', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="box">
        <div class="box-body">
            <? Pjax::begin() ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'id',
                    [
                        'attribute' => 'name',
                        'value' => function (News $model) {
                            return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'category_id',
                        'filter' => $searchModel->categoriesList(),
                        'value' => function (News $model) {
                            return $model->getParentsCategories(). ArrayHelper::getValue($model, 'category.name');
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'status',
                        'filter' => $searchModel->statusList(),
                        'value' => function (News $model) {
                            return \core\helpers\NewsHelper::statusLabel($model->status);
                        },
                        'format' => 'raw',
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
                            'link' => function ($url,News $model,$key) {
                                return Html::a(
                                    '<i class="fa fa-external-link" aria-hidden="true"></i>',
                                    Yii::$app->params['frontendHostInfo'] .'/'. $model->slug,
                                    ['target' => '_blank', 'title' => 'Посмотреть на сайте']);
                            },
                        ],
                    ],
                ],
            ]); ?>
            <? Pjax::end() ?>
        </div>
    </div>
</div>
