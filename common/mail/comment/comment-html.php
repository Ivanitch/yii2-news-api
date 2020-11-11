<?php

/* @var $this yii\web\View */
/* @var $form \core\forms\Blog\CommentForm */
/* @var $user \core\entities\User\User */
use yii\helpers\Url;
?>
<h2>Здравствуйте!</h2>
<p>На сайте <a href="http://<?= $_SERVER['HTTP_HOST']?>"><?= $_SERVER['HTTP_HOST']?></a> ответили на Ваш комментарий!</p>
<p><strong>Имя:</strong> <?= $user->username === Yii::$app->params['admin']
            ? '<span class="adm-box">Администратор</span>'
            : '@'.$user->username ?>
</p>
<p><strong>Комментарий:</strong> <?= $form['text'] ?></p>
<p>Перейти: <a href="<?= Url::to(['/blog/blog/post', 'slug' => $form->post->slug, '#' => 'comment_' . $form->comment_id], true) ?>"><?= $form->post->name ?></a></p>
