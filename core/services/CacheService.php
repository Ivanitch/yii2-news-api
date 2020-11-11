<?php
namespace core\services;

use yii\caching\Cache;
use yii\caching\TagDependency;

class CacheService
{
    public $cache;

    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    public function deleteTag(array $tag): void
    {
        TagDependency::invalidate($this->cache, $tag);
    }

    public function flush(): void
    {
        $this->cache->flush();
    }
}