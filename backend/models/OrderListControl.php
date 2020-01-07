<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\OrderList;

/**
 * OrderListControl represents the model behind the search form of `common\models\OrderList`.
 */
class OrderListControl extends OrderList
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'subjects_id', 'section_id', 'price', 'sender', 'operation_label', 'operation_id', 'is_status'], 'integer'],
            [['name', 'email', 'datetime', 'notification_type'], 'safe'],
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
        $query = OrderList::find();

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
            'user_id' => $this->user_id,
            'subjects_id' => $this->subjects_id,
            'section_id' => $this->section_id,
            'price' => $this->price,
            'sender' => $this->sender,
            'operation_label' => $this->operation_label,
            'operation_id' => $this->operation_id,
            'is_status' => $this->is_status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'datetime', $this->datetime])
            ->andFilterWhere(['like', 'notification_type', $this->notification_type]);

        return $dataProvider;
    }
}
