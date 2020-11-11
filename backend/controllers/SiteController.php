<?php
namespace backend\controllers;

use core\entities\User\User;
use core\services\CacheService;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    private $cacheService;

    public function __construct($id, $module, CacheService $cacheService, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->cacheService = $cacheService;
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @return bool|string
     * Remove cache
     */
    public function actionCleanCache()
    {
        $this->cacheService->flush();
        return $this->render('cache');
    }
}
