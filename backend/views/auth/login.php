<?php
use common\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \core\forms\auth\LoginForm */
?>
<div class="login-box">
    <div class="login-box-body">
        <?= Alert::widget() ?>
        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => true]); ?>
        <?= $form
            ->field($model, 'username')
            ->label(false)
            ->textInput(['autocomplete' => 'off']) ?>

        <?= $form
            ->field($model, 'password')
            ->label(false)
            ->passwordInput(['autocomplete' => 'off']) ?>

        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>
            <div class="col-xs-4">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>