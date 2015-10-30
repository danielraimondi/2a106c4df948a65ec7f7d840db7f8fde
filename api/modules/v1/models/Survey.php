<?php

namespace  api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "survey".
 *
 * @property string $survey_date
 * @property integer $client_id
 * @property integer $user_id
 * @property integer $prod_id
 * @property integer $stock
 * @property integer $order
 *
 * @property Product $prod
 * @property Client $client
 * @property User $user
 */
class Survey extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'survey';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_id', 'user_id', 'prod_id', 'stock', 'order'], 'required'],
            [['survey_date'], 'safe'],
            [['client_id', 'user_id', 'prod_id', 'stock', 'order'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'survey_date' => Yii::t('app', 'Survey Date'),
            'client_id' => Yii::t('app', 'Client ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'prod_id' => Yii::t('app', 'Prod ID'),
            'stock' => Yii::t('app', 'Stock'),
            'order' => Yii::t('app', 'Order'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProd()
    {
        return $this->hasOne(Product::className(), ['prod_id' => 'prod_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['client_id' => 'client_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
