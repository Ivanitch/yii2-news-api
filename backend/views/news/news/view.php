<?php

use core\entities\News\News;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \core\entities\News\News */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'All News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?php if ($model->isActive()): ?>
            <?= Html::a('Draft', ['draft', 'id' => $model->id], ['class' => 'btn btn-primary', 'data-method' => 'post']) ?>
        <?php else: ?>
            <?= Html::a('Activate', ['activate', 'id' => $model->id], ['class' => 'btn btn-success', 'data-method' => 'post']) ?>
        <?php endif; ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">Common</div>
                <div class="box-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            [
                                'attribute' => 'category_id',
                                'value' => function (News $model) {
                                    return $model->getParentsCategories(). ArrayHelper::getValue($model, 'category.name');
                                },
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'status',
                                'value' => \core\helpers\NewsHelper::statusLabel($model->status),
                                'format' => 'raw',
                            ],
                            'name',
                            'title',
                            'slug',
                            'created_at:date',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="box">
        <div class="box-header with-border">SEO</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'meta.title',
                        'value' => $model->meta->title,
                    ],
                    [
                        'attribute' => 'meta.keywords',
                        'value' => $model->meta->keywords,
                    ],
                    [
                        'attribute' => 'meta.description',
                        'value' => $model->meta->description,
                    ],
                ],
            ]) ?>
        </div>
    </div>
    <div class="box">
        <div class="box-header with-border">Content</div>
        <div class="box-body">
            <?= Yii::$app->formatter->asHtml($model->content) ?>
        </div>
    </div>
</div>
