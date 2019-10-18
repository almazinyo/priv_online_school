<?php

namespace backend\modules\grid\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;
//use app\models\GridSort;
use Yii;

/**
 * GridSortControl represents the model behind the search form about `app\models\GridSort`.
 */
class GridSortControl extends GridSort
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['visible_columns', 'default_columns', 'page_size','theme', 'class_name',"label"], 'trim'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = GridSort::find()->where(["user_id" => Yii::$app->user->id]);

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
        ]);

        $query->andFilterWhere(['like', 'visible_columns', $this->visible_columns])
            ->andFilterWhere(['like', 'default_columns', $this->default_columns])
            ->andFilterWhere(['like', 'page_size', $this->page_size])
            ->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'class_name', $this->class_name]);

        return $dataProvider;
    }
}
