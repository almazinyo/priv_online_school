<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Teachers;

/**
 * TeachersControl represents the model behind the search form of `common\models\Teachers`.
 */
class TeachersControl extends Teachers
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'section_id', 'is_status'], 'integer'],
            [['name', 'position', 'img_name', 'description', 'created_at', 'updated_at'], 'safe'],
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
        $query = Teachers::find();

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
            'section_id' => $this->section_id,
            'is_status' => $this->is_status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'img_name', $this->img_name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['like', 'updated_at', $this->updated_at]);

        return $dataProvider;
    }
}
