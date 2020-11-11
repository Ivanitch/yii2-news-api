<?php

namespace frontend\controllers\news;

use core\readModels\News\CategoryReadRepository;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class NewsController  extends Controller
{
    private $categories;

    public function __construct(
        $id,
        $module,
        CategoryReadRepository $categories,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->categories = $categories;
    }

    public function actionCategory($id)
    {
        if (!$category = $this->categories->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $this->render('category', [
            'category' => $category
        ]);
    }
}
