<?php

namespace api\core\entities\News;

use yii\helpers\Url;
use yii\web\Linkable;
use core\entities\News\Category as BaseCategory;

class Category extends BaseCategory implements Linkable
{
    public function getLinks()
    {
        return [
            'self' => $this->getCategory()
        ];
    }

    private function getCategory(): string
    {
        return Url::to(['category/view', 'id' => $this->id], true);
    }

    public function fields()
    {
        return ['id', 'name', 'lft', 'rgt', 'depth'];
    }
}
