<?php

namespace core\entities\News;

use paulzi\nestedsets\NestedSetsBehavior;
use core\entities\News\queries\CategoryQuery;
use yii\db\ActiveRecord;
/**
 * @property integer $id
 * @property string $name
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property Category $parent
 * @property Category[] $parents
 * @property Category[] $children
 * @property Category $prev
 * @property Category $next
 * @mixin NestedSetsBehavior
 */
class Category extends ActiveRecord
{
    const CACHE_ASIDE = 'CATEGORY_CACHE_ASIDE';

    public static function tableName(): string
    {
        return '{{%category}}';
    }

    public static function create($name): self
    {
        $category = new static();
        $category->name = $name;
        return $category;
    }

    public function edit($name): void
    {
        $this->name = $name;
    }

    public function behaviors(): array
    {
        return [
            NestedSetsBehavior::class,
        ];
    }

    public static function find(): CategoryQuery
    {
        return new CategoryQuery(static::class);
    }
}
