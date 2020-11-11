<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $page core\entities\Page */
$this->title = $page->title;
$this->params['breadcrumbs'][] = ['label' => 'Статичные страницы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$pageFrontUrl = Yii::$app->params['frontendHostInfo'] . "/$page->slug";
?>
<div class="user-view">
    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $page->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $page->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Посмотреть на сайте', $pageFrontUrl, ['class' => 'btn btn-default', 'target' => '_blank']) ?>
    </p>
    <div class="box">
        <div class="box-header with-border">Common</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $page,
                'attributes' => [
                    'id',
                    'title',
                    'slug',
                    'views'
                ],
            ]) ?>
        </div>
    </div>
    <div class="box">
        <div class="box-header with-border">SEO</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $page,
                'attributes' => [
                    'meta.title',
                    'meta.keywords',
                    'meta.description',
                ],
            ]) ?>
        </div>
    </div>
    <div class="box">
        <div class="box-header with-border">Content</div>
        <div class="box-body">
            <?= $page->content ?>
        </div>
    </div>
</div>