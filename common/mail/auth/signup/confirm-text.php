<?php

/* @var $this yii\web\View */
/* @var $user \core\entities\User\User */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/signup/confirm', 'token' => $user->email_confirm_token]);
?>
Здравствуйте <?= $user->username ?>,

Следуйте приведенной ниже ссылке, чтобы подтвердить свой адрес электронной почты.:

<?= $confirmLink ?>
