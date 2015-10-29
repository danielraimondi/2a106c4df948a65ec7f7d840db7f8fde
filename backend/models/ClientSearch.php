<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Client;

/**
 * ClientSearch represents the model behind the search form about `backend\models\Client`.
 */
class ClientSearch extends Client
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_id', 'priority'], 'integer'],
            [['client_name', 'client_address', 'day'], 'safe'],
            [['client_lat', 'client_long'], 'number'],
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
        $query = Client::find();

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
            'client_id' => $this->client_id,
            'client_lat' => $this->client_lat,
            'client_long' => $this->client_long,
            'priority' => $this->priority,
            'day' => $this->day,
        ]);

        $query->andFilterWhere(['like', 'client_name', $this->client_name]);
        $query->andFilterWhere(['like', 'client_address', $this->client_address]);

        return $dataProvider;
    }
}
