<?php

namespace backend\forms\News;

use core\entities\News\Category;
use core\entities\News\News;
use core\helpers\NewsHelper;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\base\Model;

class NewsSearch extends Model
{
    public $id;
    public $name;
    public $category_id;
    public $status;

    public function rules(): array
    {
        return [
            [['id', 'category_id', 'status'], 'integer'],
            [['name'], 'safe'],
        ];
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = News::find()
            ->select(['id', 'name', 'category_id', 'status', 'slug']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'status' => $this->status,
        ]);

        $query
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }

    public function categoriesList(): array
    {
        return ArrayHelper::map(Category::find()->andWhere(['>', 'depth', 0])->orderBy('lft')->asArray()->all(), 'id', function (array $category) {
            return ($category['depth'] > 1 ? str_repeat('-- ', $category['depth'] - 1) . ' ' : '') . $category['name'];
        });
    }

    public function statusList(): array
    {
        return NewsHelper::statusList();
    }
}