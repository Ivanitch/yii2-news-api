<?php

use conquer\codemirror\CodemirrorWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model core\forms\manage\PageForm */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="page-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box box-default">
        <div class="box-header with-border">Common</div>
        <div class="box-body">
            <?= $form->field($model, 'parentId')->dropDownList($model->parentsList()) ?>
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
            <?=  $form->field($model, 'content')->widget(
              CodemirrorWidget::class,
              [
                'preset' => 'php',
                'options'=>['rows' => 20],
              ]
            );
            ?>
            <?//= $form->field($model, 'content')->textarea(['rows' => 20]) ?>
        </div>
    </div>
    <div class="box box-default">
        <div class="box-header with-border">SEO</div>
        <div class="box-body">
            <?= $form->field($model->meta, 'title')->textInput() ?>
            <?= $form->field($model->meta, 'keywords')->textInput() ?>
            <?= $form->field($model->meta, 'description')->textInput() ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>