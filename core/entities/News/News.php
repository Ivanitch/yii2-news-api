<?php

namespace core\entities\News;

use core\entities\News\queries\NewsQuery;
use core\entities\behaviors\MetaBehavior;
use core\entities\Meta;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property integer $category_id
 * @property string $name
 * @property string $title
 * @property string $content
 * @property string $slug
 * @property integer $created_at
 * @property integer $status
 * @property Meta $meta
 * @property Category $category
 * @property Category[] $categories
 */
class News extends ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;

    public $meta;

    public static function tableName(): string
    {
        return '{{%news}}';
    }

    public static function create($categoryId, $name, $title, $content, $slug, Meta $meta): self
    {
        $model = new static();
        $model->category_id = $categoryId;
        $model->name = $name;
        $model->title = $title;
        $model->content = $content;
        $model->slug = $slug;
        $model->meta = $meta;
        $model->status = self::STATUS_DRAFT;
        $model->created_at = time(); // Или передавать данные календаря
        return $model;
    }

    public function edit($name, $title, $content, $slug,  Meta $meta): void
    {
        $this->name = $name;
        $this->title = $title;
        $this->content = $content;
        $this->slug = $slug;
        $this->meta = $meta;
    }

    public function changeMainCategory($categoryId): void
    {
        $this->category_id = $categoryId;
    }

    public function activate(): void
    {
        if ($this->isActive()) {
            throw new \DomainException('News is already active.');
        }
        $this->status = self::STATUS_ACTIVE;
    }

    public function draft(): void
    {
        if ($this->isDraft()) {
            throw new \DomainException('News is already draft.');
        }
        $this->status = self::STATUS_DRAFT;
    }

    public function isActive(): bool
    {
        return $this->status == self::STATUS_ACTIVE;
    }

    public function isDraft(): bool
    {
        return $this->status == self::STATUS_DRAFT;
    }

    public function getSeoTitle(): string
    {
        return $this->meta->title ?: $this->name;
    }

    public function getHeadingTile(): string
    {
        return $this->title ?: $this->name;
    }

    // ##########################
    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function behaviors(): array
    {
        return [
            MetaBehavior::class
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find(): NewsQuery
    {
        return new NewsQuery(static::class);
    }


    public function getParentsCategories(): string
    {
        $parent = $this->category->parent;
        if ($parent->id === 1) {
            $parentName = '';
        } else {
            $parentName = $parent->name . ' &rarr; ';
            if($parent->parent->id !== 1) {
                $parentName = $parent->parent->name.' &rarr; ' . $parent->name . ' &rarr; ';
            }
        }
        return $parentName;
    }
}
