<?php

namespace core\helpers;

use yii\web\View;

class PaginationHelper
{
    public static function page() {
        $page = self::getPage();
        return $page > 1 ? ' - Страница ' . $page : '';
    }

    public static function noIndex(View $view) {
        if (self::getPage() > 1) {
            $view->registerMetaTag(['name' =>'robots', 'content' => 'noindex, follow']);
        }
    }

    public static function getPage(){
        return (int)\Yii::$app->request->getQueryParam('page');
    }
}