<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $page \core\entities\Page */

$this->title = $page->getSeoTitle();
$page_title = Html::encode($page->getTitle());
$seo_description = $page->getSeoDescription();
$content = $page->getContent();

$this->registerMetaTag(['name' =>'description', 'content' => $seo_description]);

$this->params['breadcrumbs'][] = $page_title;
?>
<article class="page-view">
	<h1><?= Html::encode($page_title) ?></h1>
    <?= $content ?>
</article>