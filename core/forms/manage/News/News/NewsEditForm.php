<?php

namespace core\forms\manage\News\News;

use core\entities\News\News;
use core\forms\CompositeForm;
use core\forms\manage\MetaForm;

/**
 * @property MetaForm $meta
 * @property CategoriesForm $categories
 */
class NewsEditForm extends CompositeForm
{
    public $name;
    public $content;
    public $slug;

    private $model;

    public function __construct(News $model, $config = [])
    {
        $this->name = $model->name;
        $this->content = $model->content;
        $this->slug = $model->slug;
        $this->meta = new MetaForm($model->meta);
        $this->categories = new CategoriesForm($model);
        $this->model = $model;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            ['name', 'required'],
            [['slug', 'name'], 'string', 'max' => 255],
            [['slug', 'name'], 'unique', 'targetClass' => News::class, 'filter' => $this->model ? ['<>', 'id', $this->model->id] : null],
            ['content', 'string']
        ];
    }

    protected function internalForms(): array
    {
        return ['meta', 'categories'];
    }
}