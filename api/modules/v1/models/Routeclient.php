<?php

namespace  api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "routeclient".
 *
 * @property integer $route_id
 * @property integer $client_id
 *
 * @property Client $client
 * @property Route $route
 */
class Routeclient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'routeclient';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['route_id', 'client_id'], 'required'],
            [['route_id', 'client_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'route_id' => Yii::t('app', 'Route ID'),
            'client_id' => Yii::t('app', 'Client ID'),
        ];
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
    public function getRoute()
    {
        return $this->hasOne(Route::className(), ['route_id' => 'route_id']);
    }
}
