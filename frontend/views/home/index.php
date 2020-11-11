<?php

$this->title = 'Home page';
$this->registerMetaTag(['name' =>'description', 'content' => $this->title]);
?>
<h1><?= $this->title ?></h1>
<?php
$c_form = new \core\forms\manage\News\CategoryForm();
var_dump($c_form);
?>

