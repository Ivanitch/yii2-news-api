<?php

namespace core\forms\manage\News\News;

use core\entities\News\News;
use core\forms\CompositeForm;
use core\forms\manage\MetaForm;

/**
 * @property MetaForm $meta
 * @property CategoriesForm $categories
 */
class NewsCreateForm extends CompositeForm
{
    public $name;
    public $title;
    public $content;
    public $slug;

    public function __construct($config = [])
    {
        $this->meta = new MetaForm();
        $this->categories = new CategoriesForm();
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            ['name', 'required'],
            [['name', 'title', 'slug'], 'string', 'max' => 255],
            ['content', 'string'],
            [['name', 'slug'], 'unique', 'targetClass' => News::class],
        ];
    }

    protected function internalForms(): array
    {
        return ['meta', 'categories'];
    }
}