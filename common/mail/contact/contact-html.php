<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form \core\forms\ContactForm */


?>
<div class="contact">
    <h2>Здравствуйте!</h2>
    <p>На сайте <a href="http://<?= $_SERVER['HTTP_HOST']?>"><?= $_SERVER['HTTP_HOST']?></a> новое письмо со страницы "Контакты"!</p>
    <p><strong>Имя: </strong><?= $form['name'] ?></p>
    <p><strong>Email: </strong><?= $form['email'] ?></p>
    <p><strong>Тема: </strong><?= $form['subject'] ?></p>
    <p><strong>Письмо: </strong><?= $form['body'] ?></p>
</div>
