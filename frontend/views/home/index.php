<?php

$this->title = 'Home page';
$this->registerMetaTag(['name' =>'description', 'content' => $this->title]);
?>
<h1><?= $this->title ?></h1>
<?php
$categories = new \core\entities\News\Category();
var_dump($categories);
?>

