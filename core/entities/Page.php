<?php

namespace core\entities;

use paulzi\nestedsets\NestedSetsBehavior;
use core\entities\behaviors\MetaBehavior;
use yii\db\ActiveRecord;
/**
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property Meta $meta
 * @property Meta $views
 * @property Page $parent
 * @property Page[] $parents
 * @property Page[] $children
 * @property Page $prev
 * @property Page $next
 * @mixin NestedSetsBehavior
 */
class Page extends ActiveRecord
{
    public $meta;

    public static function create($title, $slug, $content, Meta $meta): self
    {
        $page = new static();
        $page->title = $title;
        $page->slug = $slug;
        $page->content = $content;
        $page->meta = $meta;
        return $page;
    }

    public function edit($title, $slug, $content, Meta $meta): void
    {
        $this->title = $title;
        $this->slug = $slug;
        $this->content = $content;
        $this->meta = $meta;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getSeoTitle(): string
    {
        return $this->meta->title ?: $this->title;
    }

    public function getSeoDescription(): string
    {
        return $this->meta->description;
    }

    public static function tableName(): string
    {
        return '{{%page}}';
    }

    public function behaviors(): array
    {
        return [
            MetaBehavior::class,
            NestedSetsBehavior::class,
        ];
    }

    public function transactions(): array
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Название',
            'slug' => 'Алиас',
            'content' => 'Контент'
        ];
    }

    /**
     * @return bool
     */
    public function viewedCounter()
    {
        $this->views += 1;
        return $this->save(false);
    }
}