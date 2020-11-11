<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $category \core\entities\News\Category */
/* @var $dataProvider \yii\data\DataProviderInterface */

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
<hr>
<? Pjax::begin([
    'id' => 'linkPagerCategory',
    'scrollTo' => true,
    'linkSelector'=>'.pagination a',
    'timeout' => 3000
]) ?>
<?= $this->render('_list', [
    'dataProvider' => $dataProvider
]) ?>
<? \yii\widgets\Pjax::end() ?>