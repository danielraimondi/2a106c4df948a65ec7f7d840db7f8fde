<?php

namespace  api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "route".
 *
 * @property integer $route_id
 * @property string $route_date
 * @property integer $user_id
 *
 * @property Route-client[] $route-clients
 * @property Client[] $clients
 */
class Route extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'route';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['route_date', 'user_id'], 'required'],
            [['route_date'], 'safe'],
            [['user_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'route_id' => Yii::t('app', 'Route ID'),
            'route_date' => Yii::t('app', 'Route Date'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRouteclients()
    {
        return $this->hasMany(Route-client::className(), ['route_id' => 'route_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClients()
    {
        return $this->hasMany(Client::className(), ['client_id' => 'client_id'])->viaTable('route-client', ['route_id' => 'route_id']);
    }
}
