<?php

namespace core\entities\News;

use yii\db\ActiveRecord;

/**
 * @property integer $news_id;
 * @property integer $category_id;
 */
class CategoryAssignment extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%category_assignments}}';
    }

    public static function create($categoryId): self
    {
        $assignment = new static();
        $assignment->category_id = $categoryId;
        return $assignment;
    }

    public function isForCategory($id): bool
    {
        return $this->category_id == $id;
    }
}
