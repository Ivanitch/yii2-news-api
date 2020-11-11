<?php
/* @var $this yii\web\View */
/* @var $model \core\entities\News\News */

$this->title = $model->getSeoTitle();
$header = $model->getHeadingTile();
$keywords = $model->meta->keywords;
$description = $model->meta->description;
$created_at = Yii::$app->formatter->asDate($model->created_at);
$category = $model->category;

$this->registerMetaTag(['name' =>'keywords', 'content' => $keywords]);
$this->registerMetaTag(['name' =>'description', 'content' => $description]);
$this->params['active_category'] = $category;
?>
<article class="news">
    <h1 class="post-title"><?= $header ?></h1>
    <hr>
    <!--noindex-->
    <!--googleoff:index-->
    <p>Добавлено: <?= $created_at ?> | Категория: <?= $model->getParentsCategories() . $category->name ?></p>
    <!--googleon:index-->
    <!--/noindex-->
    <hr>
    <div class="news-content">
        <?= $model->content ?>
    </div>
</article>