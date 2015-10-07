<?php

namespace backend\models;

use Yii;


class Comercio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $file;
    
    public static function tableName()
    {
        return 'comercio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'id', 'laitud', 'longitud', 'prioridad', 'horario_apertura', 'horario_cierre', 'productos'], 'required'],
            [['id'], 'integer'],
            [['logitud', 'logitud'], 'float'],
            [['horario_apertura', 'horario_cierre'], 'hour'],
            [['nombre', 'prioridad'], 'string', 'max' => 255],
            [['productos'], 'arry(Product)'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'laitud' => Yii::t('app', 'Latitud'),
            'longitud' => Yii::t('app', 'Longitud'),
            'horario_apertura' => Yii::t('app', 'Abre'),
            'horario_cierre' => Yii::t('app', 'Cierra'),
            'productos' => Yii::t('app', 'Productos')
        ];
    }

    
    
  
}
