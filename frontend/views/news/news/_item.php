<?
/**
 * @var $item \core\entities\News\News
 */
use yii\helpers\Url;

$slug = $item->slug;
$name = $item->name;
$url = Url::to(['/news/news/view', 'slug' => $slug]);
?>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="<?= $url ?>"><?= $name ?></a>
        </div>
    </div>
</div>