<?php

/* @var $this yii\web\View */
/* @var $page core\entities\Page */
/* @var $model core\forms\manage\PageForm */

$this->title = 'Редактировать страницу: ' . $page->title;
$this->params['breadcrumbs'][] = ['label' => 'Статичные страницы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $page->title, 'url' => ['view', 'id' => $page->id]];
$this->params['breadcrumbs'][] = 'Редактировние';
?>
<div class="page-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
