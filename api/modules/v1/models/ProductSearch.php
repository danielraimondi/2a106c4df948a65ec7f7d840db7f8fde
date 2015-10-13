<?php

namespace  api\modules\v1\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Product;

/**
 * ProductSearch represents the model behind the search form about `backend\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['prod_id'], 'integer'],
            [['prod_name', 'cat_id'], 'safe'],
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
        $query = Product::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        $query->joinWith('cat');
        
        $query->andFilterWhere([
            'prod_id' => $this->prod_id,
            //'cat_id' => $this->cat_id,
        ]);

        $query->andFilterWhere(['like', 'prod_name', $this->prod_name]);
        $query->andFilterWhere(['like', 'product_cat.cat_name', $this->cat_id]);

        return $dataProvider;
    }
}
