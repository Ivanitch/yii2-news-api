<?php

namespace api\controllers;

use api\core\entities\News\News;
use api\models\NewsSearch;
use core\forms\manage\News\News\NewsCreateForm;
use core\forms\manage\News\News\NewsEditForm;
use core\services\manage\News\NewsManageService;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

class NewsController extends AbstractRestController
{
    /* @var $modelClass News */
    public $modelClass = News::class;

    /**
     * @var NewsManageService
     */
    private $service;

    /**
     * NewsController constructor.
     * @param $id
     * @param $module
     * @param NewsManageService $service
     * @param array $config
     */
    public function __construct(
        $id,
        $module,
        NewsManageService $service,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    /**
     * @return \core\entities\News\News
     * @throws HttpException
     */
    public function actionCreate()
    {
        $form = new NewsCreateForm();
        $form->load($this->args, '');
        $this->assertIsNotRoot($form);
        if($form->validate()){
            $model = $this->service->create($form);
            $this->response->setStatusCode(201);
            $id = implode(',', array_values($model->getPrimaryKey(true)));
            $this->response->getHeaders()->set('Location', Url::toRoute(['view', 'id' => $id], true));
        } else {
            throw new HttpException(422 , json_encode($form->errors, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
        }
        return $model;
    }

    /**
     * @param $id
     * @return News
     * @throws HttpException
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $form = new NewsEditForm($model);
        $form->load($this->args, '');
        $this->assertIsNotRoot($form);
        if($form->validate()){
            $this->service->edit($id, $form);
            $this->response->setStatusCode(204);
        } else {
            throw new HttpException(422 , json_encode($form->errors, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
        }
        return $model;
    }

    /**
     * @param $id
     * @return string
     */
    public function actionActivate($id)
    {
        $this->service->activate($id);
        return 'News published.';
    }

    /**
     * @return \yii\data\ActiveDataProvider
     */
    public function prepareDataProvider()
    {
        $searchModel = new NewsSearch();
        return $searchModel->search($this->args);
    }

    /**
     * @return array
     */
    public function actions(): array
    {
        $actions = parent::actions();
        unset(
            $actions['create'],
            $actions['update'],
        );
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
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
                'delete' => ['delete'],
                'activate' => ['put', 'patch'],
            ],
        ];

        return $behaviors;
    }

    /**
     * @param $id
     * @return News
     * @throws NotFoundHttpException
     */
    protected function findModel($id): News
    {
        if (($model = $this->modelClass::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @return array|string[]
     */
    protected function checkActions(): array
    {
        return ['index', 'create', 'update', 'delete', 'view', 'activate'];
    }

    /**
     * @param $form
     */
    private function assertIsNotRoot($form)
    {
        if ($form->categories->main === 1 || in_array(1, $form->categories->others)) {
            throw new \RuntimeException('It is forbidden to add news to the Root category.');
        }
    }
}