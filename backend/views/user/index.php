<?php

use kartik\date\DatePicker;
use core\entities\User\User;
use core\helpers\UserHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use backend\widgets\grid\RoleColumn;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <p>
        <?= Html::a('<i class="fa fa-plus"></i> Добавить пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="box">
        <div class="box-body">
            <? \yii\widgets\Pjax::begin() ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'id',
                    [
                        'attribute' => 'created_at',
                        'filter' => DatePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'date_from',
                            'attribute2' => 'date_to',
                            'type' => DatePicker::TYPE_RANGE,
                            'separator' => '-',
                            'pluginOptions' => [
                                'todayHighlight' => true,
                                'autoclose'=>true,
                                'format' => 'yyyy-mm-dd',
                            ],
                        ]),
                        'format' => 'date',
                    ],
                    [
                        'attribute' => 'username',
                        'value' => function (User $model) {
                            return Html::a(Html::encode($model->username), ['view', 'id' => $model->id]);
                        },
                        'format' => 'raw',
                    ],
                    'email:email',
                    [
                        'attribute' => 'role',
                        'class' => RoleColumn::class,
                        'filter' => $searchModel->rolesList(),
                    ],
                    [
                        'attribute' => 'status',
                        'filter' => UserHelper::statusList(),
                        'value' => function (User $model) {
                            return UserHelper::statusLabel($model->status);
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
//                            'link' => function ($url,User $model,$key) {
//                                return Html::a(
//                                    '<i class="fa fa-external-link" aria-hidden="true"></i>',
//                                    Yii::$app->params['frontendHostInfo'] . '/articles/'.$model->getCategorySlug().'/'. $model->getSlug(),
//                                    ['target' => '_blank', 'title' => 'Посмотреть на сайте']);
//                            },
                        ],
                    ],
                ],
            ]); ?>
            <? \yii\widgets\Pjax::end() ?>
        </div>
    </div>
</div>
