<?php

/* @var $this yii\web\View */
/* @var $form \core\forms\Blog\CommentForm */
/* @var $post \core\entities\Blog\Post\Post */
/* @var $user \core\entities\User\User */

?>
<h2>Здравствуйте!</h2>
<p>На сайте <a href="http://<?= $_SERVER['HTTP_HOST']?>"><?= $_SERVER['HTTP_HOST']?></a> новый комментарий!</p>
<p><strong>Имя: </strong><?= $user->username ?></p>
<p><strong>Комментарий: </strong><?= $form['text'] ?></p>
<p>Перейти: <a href="<?= Yii::$app->params['backendHostInfo'].'/blog/comment/view?post_id='.$form->post->id.'&id='.$form->comment_id ?>"><?= $form->post->name ?></a></p>
