<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \core\forms\auth\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Вход';
$this->registerMetaTag(['name' =>'robots', 'content' => 'none']);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Ещё нет аккаунта? <a href="<?= \yii\helpers\Url::to(['auth/signup/request']) ?>" class="link" rel="nofollow" title="Регистрация">Регистрация</a>. Для входа на сайт заполните следующие поля:</p>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'rememberMe')->checkbox() ?>
            <?= $form->field($model, 'check')->hiddenInput([
                'type' => 'hidden',
                'id' => 'check_login',
                'value' => '',
            ])->label(false) ?>
            <div class="form-group">
                <?= Html::submitButton('Войти', [
                    'class' => 'btn btn-default', 'name' => 'login-button',
                    'id' => 'btn-login',
                    'onclick'=>"document.getElementById('check_login').value = 'nospam';"
                ]) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    Если вы забыли свой пароль, вы можете <?= Html::a('сбросить', ['auth/reset/request'], ['class' => 'link', 'rel' => 'nofollow', 'title' => 'Сбросить пароль']) ?> его.
</div>