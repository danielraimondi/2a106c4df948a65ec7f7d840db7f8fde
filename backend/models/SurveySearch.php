<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Survey;

/**
 * SurveySearch represents the model behind the search form about `backend\models\Survey`.
 */
class SurveySearch extends Survey
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['survey_date','client_id', 'user_id', 'prod_id'], 'safe'],
            [['stock', 'order'], 'integer'],
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
        $query = Survey::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        $query->joinWith('user');
        $query->joinWith('prod');
        $query->joinWith('client');

        $query->andFilterWhere([
            'survey_date' => $this->survey_date,
            // 'client_id' => $this->client_id,
            // 'user_id' => $this->user_id,
            // 'prod_id' => $this->prod_id,
            'stock' => $this->stock,
            'order' => $this->order,
        ]);
        
        $query->andFilterWhere(['like', 'user.username', $this->user_id]);
        $query->andFilterWhere(['like', 'client.client_name', $this->client_id]);
        $query->andFilterWhere(['like', 'product.prod_name', $this->prod_id]);

        return $dataProvider;
    }
}
