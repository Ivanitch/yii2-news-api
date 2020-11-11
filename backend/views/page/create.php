<?php

/* @var $this yii\web\View */
/* @var $model core\forms\manage\PageForm */

$this->title = 'Новая страница';
$this->params['breadcrumbs'][] = ['label' => 'Статичные страницы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
