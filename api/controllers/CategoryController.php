<?php

namespace api\controllers;

use api\core\entities\News\Category;
use api\models\CategorySearch;
use core\forms\manage\News\CategoryForm;
use core\services\manage\News\CategoryManageService;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;

class CategoryController extends AbstractRestController
{
    /* @var $modelClass Category */
    public $modelClass = Category::class;

    /**
     * @var CategoryManageService
     */
    private $service;

    /**
     * CategoryController constructor.
     * @param $id
     * @param $module
     * @param CategoryManageService $service
     * @param array $config
     */
    public function __construct(
        $id,
        $module,
        CategoryManageService $service,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    /**
     * @return ActiveDataProvider
     */
    public function actionIndex(): ActiveDataProvider
    {
        return $this->prepareDataProvider();
    }

    /**
     * @return \core\entities\News\Category
     * @throws HttpException
     */
    public function actionCreate()
    {
        $form = new CategoryForm();
        if($form->load($this->args, '') && $form->validate()){
            $category = $this->service->create($form);
            // Clear cache here if needed
            $this->response->setStatusCode(201);
            $id = implode(',', array_values($category->getPrimaryKey(true)));
            $this->response->getHeaders()->set('Location', Url::toRoute(['view', 'id' => $id], true));
        } else {
            throw new HttpException(422 , json_encode($form->errors, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
        }
        return $category;
    }

    /**
     * @param $id
     * @return Category
     * @throws HttpException
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $category = $this->findModel($id);
        $form = new CategoryForm($category);
        $form->load($this->args, '');
        if($form->validate()){
            $this->service->edit($id, $form);
            // Clear cache here if needed
            $this->response->setStatusCode(204);
        } else {
            throw new HttpException(422 , json_encode($form->errors, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
        }
        return $category;
    }

    /**
     * @param $id
     */
    public function actionDelete($id)
    {
        $this->service->remove($id);
        // Clear cache here if needed
        \Yii::$app->getResponse()->setStatusCode(204);
    }

    /**
     * @param $id
     * @return Category
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $category = $this->findModel($id);
        if (!$category->isRoot()) return $category;
        throw new \DomainException('Unable to view the root category.');
    }


    /**
     * @return ActiveDataProvider
     */
    private function prepareDataProvider(): ActiveDataProvider
    {
        $searchModel = new CategorySearch();
        return $searchModel->search($this->args);
    }

    /**
     * @return array
     */
    public function actions(): array
    {
        $actions = parent::actions();
        unset(
            $actions['index'],
            $actions['create'],
            $actions['update'],
            $actions['view'],
            $actions['delete']
        );
        return $actions;
    }

    /**
     * @return array
     */
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['verbs'] = [
            'class' => VerbFilter::class,
            'actions' => [
                'index' => ['get'],
                'create' => ['post'],
                'update' => ['put', 'patch'],
                'view' => ['get'],
                'delete' => ['delete']
            ],
        ];

        return $behaviors;
    }

    /**
     * @return array|string[]
     */
    protected function checkActions(): array
    {
        return ['index', 'create', 'update', 'delete', 'view'];
    }

    /**
     * @param $id
     * @return Category
     * @throws NotFoundHttpException
     */
    protected function findModel($id): Category
    {
        if (($model = $this->modelClass::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
