<?php
/* @var $this yii\web\View */
/* @var $model core\forms\manage\User\UserCreateForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Создать пользователя';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'username')->label('Логин')->textInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'email')->label('Email')->textInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'password')->label('Пароль')->passwordInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'role')->dropDownList($model->rolesList()) ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>