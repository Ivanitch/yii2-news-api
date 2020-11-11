<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user \core\entities\User\User */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/signup/confirm', 'token' => $user->email_confirm_token]);
?>
<div class="password-reset">
    <p>Здравствуйте <?= Html::encode($user->username) ?>!</p>
    <p>Вы успешно зарегистрировались на сайте <?=Yii::$app->urlManager->createAbsoluteUrl(['/']) ?>.</p>

    <p>Следуйте приведенной ниже ссылке, чтобы подтвердить свой адрес электронной почты и войти на сайт:</p>

    <p><?= Html::a(Html::encode($confirmLink), $confirmLink) ?></p>
</div>
