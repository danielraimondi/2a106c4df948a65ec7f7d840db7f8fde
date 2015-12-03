<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Route;

/**
 * RouteSearch represents the model behind the search form about `backend\models\Route`.
 */
class RouteSearch extends Route
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
            [['route_date', 'user_id', 'client_id'], 'safe'],
            
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
        $query = Route::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            
            'route_date' => $this->route_date,
            //'user_id' => $this->user_id,
        ]);
        
        $query->joinWith('relevator');
        $query->joinWith('client');
        $query->andFilterWhere(['like', 'user.username', $this->user_id]);
        $query->andFilterWhere(['like', 'client.client_name', $this->client_id]);

        return $dataProvider;
    }
}
