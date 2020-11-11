<?php

namespace frontend\controllers\news;

use core\readModels\News\CategoryReadRepository;
use core\readModels\News\NewsReadRepository;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class NewsController  extends Controller
{
    private $categories;
    private $news;

    public function __construct(
        $id,
        $module,
        CategoryReadRepository $categories,
        NewsReadRepository $news,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->categories = $categories;
        $this->news = $news;
    }

    public function actionCategory($id)
    {
        if (!$category = $this->categories->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $this->render('category', [
            'category' => $category,
            'dataProvider' => $this->news->getAllByCategory($category)
        ]);
    }


    public function actionView($slug)
    {
        if (!$model = $this->news->getBySlug($slug)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $this->render('view', [
            'model' => $model
        ]);
    }
}
