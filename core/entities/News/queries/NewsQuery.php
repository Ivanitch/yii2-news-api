<?php

namespace core\entities\News\queries;

use core\entities\News\News;
use yii\db\ActiveQuery;

class NewsQuery extends ActiveQuery
{
    function active(): self
    {
        return $this->andWhere(['status' => News::STATUS_ACTIVE]);
    }
}
