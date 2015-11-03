<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Routeclient;

/**
 * RouteclientSearch represents the model behind the search form about `backend\models\Routeclient`.
 */
class RouteclientSearch extends Routeclient
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['route_id', 'client_id'], 'integer'],
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
        $query = Routeclient::find();

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
            'route_id' => $this->route_id,
            'client_id' => $this->client_id,
        ]);

        return $dataProvider;
    }
}
