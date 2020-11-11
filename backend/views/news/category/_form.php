<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model core\forms\manage\News\CategoryForm */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'parentId')->dropDownList($model->parentCategoriesList()) ?>
<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
