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
            'self' => $this->category(),
            'children' => $this->children()
        ];
    }

    private function category(): string
    {
        return Url::to(['category/view', 'id' => $this->id], true);
    }

    private function children()
    {
        return $this->children;
    }

    public function fields()
    {
        return ['id', 'name'];
    }
}
