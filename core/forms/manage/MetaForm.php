<?php

namespace core\forms\manage;

use core\entities\Meta;
use yii\base\Model;

class MetaForm extends Model
{
    public $title;
    public $keywords;
    public $description;

    public function __construct(Meta $meta = null, $config = [])
    {
        if ($meta) {
            $this->title = $meta->title;
            $this->keywords = $meta->keywords;
            $this->description = $meta->description;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            ['description', 'required'],
            ['keywords', 'string', 'max' => 64],
            ['title', 'string', 'max' => 128],
            ['description', 'string']
        ];
    }


    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок страницы',
            'keywords' => 'Ключевые слова',
            'description' => 'Краткое описание'
        ];
    }
}