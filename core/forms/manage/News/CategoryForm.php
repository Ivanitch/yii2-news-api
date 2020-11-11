<?php

namespace core\forms\manage\News;

use core\entities\News\Category;
use core\forms\CompositeForm;
use yii\helpers\ArrayHelper;

class CategoryForm extends CompositeForm
{
    public $name;
    public $parentId;

    private $category;

    public function __construct(Category $category = null, $config = [])
    {
        if ($category) {
            $this->name = $category->name;
            $this->parentId = $category->parent ? $category->parent->id : null;
            $this->category = $category;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            ['name', 'required'],
            ['parentId', 'integer'],
            ['name', 'string', 'max' => 255],
            ['name', 'unique', 'targetClass' => Category::class, 'filter' => $this->category ? ['<>', 'id', $this->category->id] : null]
        ];
    }

    public function parentCategoriesList(): array
    {
        return ArrayHelper::map(Category::find()->orderBy('lft')->asArray()->all(), 'id', function (array $category) {
            return ($category['depth'] > 1 ? str_repeat('-- ', $category['depth'] - 1) . ' ' : '') . $category['name'];
        });
    }

    public function internalForms(): array
    {
        return [false];
    }
}
