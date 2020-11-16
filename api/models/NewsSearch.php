<?php

namespace api\models;

use api\core\entities\News\News;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class NewsSearch extends Model
{
    public $id;
    public $name;

    public function rules(): array
    {
        return [
            [['id'], 'integer'],
            [['name', 'title'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = News::find()
            ->select(['id', 'name'])
            ->active();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_ASC]
            ],
            'pagination' => [
                'pageSize' => \Yii::$app->params['apiPageSize'],
                'pageParam' => 'page',
                'forcePageParam' => false,
                'pageSizeParam'  => false,
                'validatePage'   => false,
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}