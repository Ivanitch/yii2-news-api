<?php
namespace frontend\controllers;

use core\services\sitemap\IndexItem;
use core\services\sitemap\MapItem;
use core\services\sitemap\Sitemap;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;

class SitemapController extends Controller
{
    const ITEMS_PER_PAGE = 10;

    private $site_map;
    //private $posts;

    public function __construct(
      $id,
      $module,
      Sitemap $sitemap,
      //PostReadRepository $posts,
      $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->site_map = $sitemap;
        //$this->posts = $posts;
    }

    /**
     * @return Response
     */
    public function actionIndex(): Response
    {
        return $this->renderSitemap('sitemap-index', function () {
            return $this->site_map->generateIndex([
                //new IndexItem(Url::to(['posts'], true)),
            ]);
        });
    }

    /**
     * @return Response
     */
//    public function actionPosts(): Response
//    {
//        return $this->renderSitemap('sitemap-posts', function () {
//            return $this->sitemap->generateMap(array_map(function (Article $article) {
//                return new MapItem(
//                    Url::to(['/ulr', 'slug' => $article->getSlug()],true),
//                    $article->getUpdatedAt(),
//                    MapItem::DAILY,
//                    0.8
//
//                );
//            }, $this->posts->getArticlesBySiteMap()));
//        });
//    }

    /**
     * @param $key
     * @param callable $callback
     * @return Response
     */
    private function renderSitemap($key, callable $callback): Response
    {
        return \Yii::$app->response->sendContentAsFile(\Yii::$app->cache->getOrSet($key, $callback, 3600 * 24), Url::canonical(), [
            'mimeType' => 'application/xml',
            'inline' => true
        ]);
    }
}