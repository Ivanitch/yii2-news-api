<?php

/* @var $this yii\web\View */
/* @var $user \core\entities\User\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/reset/confirm', 'token' => $user->password_reset_token]);
?>
Здравствуйте <?= $user->username ?>,

Следуйте приведенной ниже ссылке, чтобы сбросить пароль:

<?= $resetLink ?>
