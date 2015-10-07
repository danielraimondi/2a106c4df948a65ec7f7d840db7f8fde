<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "client".
 *
 * @property integer $client_id
 * @property string $client_name
 * @property double $client_lat
 * @property double $client_long
 * @property integer $priority
 * @property string $open_time
 * @property string $close_time
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_name', 'client_lat', 'client_address', 'client_long', 'priority', 'open_time', 'close_time'], 'required'],
            [['client_id', 'priority'], 'integer'],
            [['client_lat', 'client_long'], 'number'],
            [['open_time', 'close_time'], 'safe'],
            [['client_name', 'client_address'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'client_id' => Yii::t('app', 'Client ID'),
            'client_name' => Yii::t('app', 'Client Name'),
            'client_address' => Yii::t('app', 'Client Address'),
            //'client_lat' => Yii::t('app', 'Client Lat'),
            //'client_long' => Yii::t('app', 'Client Long'),
            'priority' => Yii::t('app', 'Priority'),
            'open_time' => Yii::t('app', 'Open Time'),
            'close_time' => Yii::t('app', 'Close Time'),
        ];
    }
}
