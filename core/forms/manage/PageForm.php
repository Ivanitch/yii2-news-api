<?php

namespace core\forms\manage;

use core\entities\Page;
use core\forms\CompositeForm;
use core\validators\SlugValidator;
use yii\helpers\ArrayHelper;

/**
 * @property MetaForm $meta;
 */
class PageForm extends CompositeForm
{
    public $title;
    public $slug;
    public $content;
    public $parentId;

    private $page;

    public function __construct(Page $page = null, $config = [])
    {
        if ($page) {
            $this->title = $page->title;
            $this->slug = $page->slug;
            $this->content = $page->content;
            $this->parentId = $page->parent ? $page->parent->id : null;
            $this->meta = new MetaForm($page->meta);
            $this->page = $page;
        } else {
            $this->meta = new MetaForm();
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['title'], 'required'],
            [['parentId'], 'integer'],
            [['title', 'slug'], 'string', 'max' => 255],
            [['content'], 'string'],
            ['slug', SlugValidator::class],
            [['slug'], 'unique', 'targetClass' => Page::class, 'filter' => $this->page ? ['<>', 'id', $this->page->id] : null]
        ];
    }

    public function parentsList(): array
    {
        return ArrayHelper::map(Page::find()->orderBy('lft')->asArray()->all(), 'id', function (array $page) {
            return ($page['depth'] > 1 ? str_repeat('-- ', $page['depth'] - 1) . ' ' : '') . $page['title'];
        });
    }

    public function internalForms(): array
    {
        return ['meta'];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Название',
            'slug' => 'Алиас',
            'content' => 'Контент'
        ];
    }

}