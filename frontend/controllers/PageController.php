<?php
namespace frontend\controllers;


use core\readModels\PageReadRepository;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PageController extends Controller
{
    private $repository;

    public function __construct($id, $module, PageReadRepository $repository, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->repository = $repository;
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     * @internal param string $slug
     */
    public function actionView($id)
    {
        if (!$page = $this->repository->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $page->viewedCounter();

        return $this->render('view', [
            'page' => $page,
        ]);
    }
}