<?php

namespace api\core\entities\News;

use yii\helpers\Url;
use yii\web\Linkable;
use core\entities\News\News as BaseNews;

class News extends BaseNews implements Linkable
{
    public function getLinks()
    {
        return [
            'self' => $this->news()
        ];
    }

    /**
     * @return string
     */
    private function news(): string
    {
        return Url::to(['news/view', 'id' => $this->id], true);
    }
}