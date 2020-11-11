<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $category \core\entities\News\Category */

$this->title = Html::encode($category->name);

foreach ($category->parents as $parent) {
    if (!$parent->isRoot()) {
        $this->params['breadcrumbs'][] = ['label' => $parent->name, 'url' => ['category', 'id' => $parent->id]];
    }
}
$this->params['breadcrumbs'][] = $category->name;
$this->params['active_category'] = $category;
?>
<h1><?= $this->title ?></h1>
