<?php

/* @var $this yii\web\View */
/* @var $exception; === стек */
/* @var $statusCode; === код ошибки  */
/* @var $name; === имя ошибки  */
/* @var $message; === текс ошибка */

use yii\helpers\Html;
$this->title = nl2br(Html::encode($statusCode));
$string   = 'Failed';
$pos = strpos($message, $string);
?>
<? if ($pos === false): ?>
    <div id="not_found">
        <p>Status Code: <?= nl2br(Html::encode($statusCode)) ?></p>
    </div>
<?  else: ?>
    <div id="not_found">
        <p>HTTP: <span>500</span></p>
        <code><span>Internal Server Error</span></code>
    </div>
    <div class="not_found-footer">
        <p>Ошибка сервера. Сайт будет доступен через некоторое время.</p>
    </div>
<? endif; ?>