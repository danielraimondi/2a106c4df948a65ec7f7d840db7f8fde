<?php

namespace  api\modules\v1\models;

use Yii;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "client".
 *
 * @property integer $client_id
 * @property string $client_name
 * @property string $client_adress
 * @property float $client_lat
 * @property float $client_long
 * @property integer $priority
 * @property time $open_time
 * @property time $close_time
 *

 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $file;
    
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
            [['client_id','client_name', 'client_adress', 'client_lat','client_long','priority','day'], 'required'],
            [['cat_id' , 'priority'], 'integer'],
            [['client_lat','client_long'],'float'],
            [['client_name', 'client_adress'], 'string', 'max' => 255]
        ];
    }

    public static function primaryKey()
    {
        return ['client_id'];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'client_id' => Yii::t('app', 'Client ID'),
            'client_name' => Yii::t('app', 'Client'),
            'client_adress' => Yii::t('app', 'Adress'),
            'client_lat' => Yii::t('app', 'Latitud'),
            'client_long' => Yii::t('app', 'Longitud'),
            'priority' => Yii::t('app', 'Prioridad'),
            'day' => Yii::t('app', 'Day of the week'),
        ];
    }

    
  
}
