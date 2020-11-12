<?php

namespace core\readModels\News;

use core\entities\News\Category;
use core\services\CacheService;
use yii\caching\TagDependency;

class CategoryReadRepository
{
    private $cacheService;

    public function __construct(CacheService $cacheService)
    {
        $this->cacheService = $cacheService;
    }

    public function find($id)
    {
        return Category::find()->where(['id' => $id])->andWhere(['>', 'depth', 0])->one();
    }

    public function getTree(Category $category = null): array
    {
        $key = Category::CACHE_ASIDE;
        $query = Category::find()
            ->andWhere(['>', 'depth', 0])
            ->orderBy('lft');

        return $this->cacheService->cache->getOrSet($key, function () use ($query) {
            return $query->all();
        }, 0, new TagDependency([
            'tags' => $key
        ]));
    }
}
