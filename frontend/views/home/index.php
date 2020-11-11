<?php

$this->title = 'Home page';
$this->registerMetaTag(['name' =>'description', 'content' => $this->title]);
?>
<h1><?= $this->title ?></h1>
<?
$news = new core\entities\News\News();
var_dump($news);
?>