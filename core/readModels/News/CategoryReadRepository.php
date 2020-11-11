<?php

namespace core\readModels\News;

use core\entities\News\Category;

class CategoryReadRepository
{
    public function find($id)
    {
        return Category::find()->where(['id' => $id])->andWhere(['>', 'depth', 0])->one();
    }

    public function getTree(Category $category = null)
    {
        return Category::find()
            ->andWhere(['>', 'depth', 0])
            ->orderBy('lft')
            ->all();
    }
}
