<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Lessons;

/**
 * LessonsControl represents the model behind the search form of `common\models\Lessons`.
 */
class LessonsControl extends Lessons
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sort_lessons', 'section_id', 'is_status'], 'integer'],
            [
                [
                    'name',
                    'background',
                    'logo',
                    'price',
                    'slug',
                    'short_description',
                    'description',
                    'seo_keywords',
                    'seo_description',
                    'created_at',
                    'updated_at',
                ],
                'trim',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Lessons::find()->orderBy(['id'=>SORT_DESC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'sort_lessons' => $this->sort_lessons,
            'section_id' => $this->section_id,
            'is_status' => $this->is_status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'background', $this->background])
            ->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'short_description', $this->short_description])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'seo_keywords', $this->seo_keywords])
            ->andFilterWhere(['like', 'seo_description', $this->seo_description])
            ->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['like', 'updated_at', $this->updated_at])
        ;

        return $dataProvider;
    }
}
