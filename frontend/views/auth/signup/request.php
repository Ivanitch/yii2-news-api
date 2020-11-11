<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \core\forms\auth\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
$this->registerMetaTag(['name' =>'robots', 'content' => 'none']);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Уже есть аккаунт? <a href="<?= \yii\helpers\Url::to(['auth/auth/login']) ?>" rel="nofollow" class="link" title="Войти">Войти</a>. Для регистрации заполните следующие поля:</p>
    <div class="row">
        <div class="col-lg-6">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Логин: <span class="field_required">*</span>') ?>

            <?= $form->field($model, 'email')->label('Email: <span class="field_required">*</span>') ?>

            <?= $form->field($model, 'password')->passwordInput()->label('Пароль: <span class="field_required">*</span>') ?>

            <?= $form->field($model, 'check')->hiddenInput([
                'type' => 'hidden',
                'id' => 'check_signup',
                'value' => '',
            ])->label(false) ?>
            <div class="form-group">
                <?= Html::submitButton('Регистрация', [
                    'class' => 'btn btn-default',
                    'name' => 'signup-button',
                    'onclick'=>"document.getElementById('check_signup').value = 'nospam';"
                ]) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>