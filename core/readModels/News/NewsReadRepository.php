<?php

namespace core\readModels\News;

use core\entities\News\Category;
use core\entities\News\News;
use yii\helpers\ArrayHelper;

class NewsReadRepository
{
    public function count(): int
    {
        return News::find()->active()->count();
    }

    public function find($id): ?News
    {
        return News::find()->active()->andWhere(['id' => $id])->one();
    }

    public function getBySlug($slug): ?News
    {
        return News::find()->active()->where(['slug' => $slug])->one();
    }

    public function getAllByCategory(Category $category)
    {
        $query = News::find()->alias('p')->active();
        $ids = ArrayHelper::merge([$category->id], $category->getDescendants()->select('id')->column());
        $query->andWhere(['or', ['p.category_id' => $ids], ['ca.category_id' => $ids]]);
        $query->groupBy('p.id');
        return $query->all();
    }
}