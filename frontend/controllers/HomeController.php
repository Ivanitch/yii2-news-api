<?php

namespace frontend\controllers;

use yii\web\Controller;

class HomeController extends Controller
{
    public function actionIndex()
    {
        $this->layout = 'home';
        \Yii::$app->session->setFlash('info', 'Добро пожаловать на сайт!');
        return $this->render('index');
    }
}