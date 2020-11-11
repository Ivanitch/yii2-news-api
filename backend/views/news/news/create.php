<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \core\forms\manage\News\News\NewsCreateForm */

$this->title = 'Create News';
$this->params['breadcrumbs'][] = ['label' => 'All news', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin([
    'options' => ['enctype'=>'multipart/form-data']
]); ?>
<div class="box box-default">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">Categories</div>
                <div class="box-body">
                    <?= $form->field($model->categories, 'main')->dropDownList($model->categories->categoriesList(), ['prompt' => '']) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="box-body">
        <div class="box-header with-border">Common</div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <?= $form->field($model, 'content')->textarea(['rows' => 10]) ?>
    </div>
</div>
<div class="box box-default">
    <div class="box-header with-border">SEO</div>
    <div class="box-body">
        <?= $form->field($model->meta, 'title')->textInput() ?>
        <?= $form->field($model->meta, 'keywords')->textInput() ?>
        <?= $form->field($model->meta, 'description')->textarea(['rows' => 2]) ?>
    </div>
</div>
<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
