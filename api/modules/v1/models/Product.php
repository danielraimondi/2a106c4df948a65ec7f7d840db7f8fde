<?php

namespace  api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $prod_id
 * @property string $prod_name
 * @property integer $cat_id
 *
 * @property ProductCat $cat
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $file;
    
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['prod_name', 'cat_id'], 'required'],
            [['cat_id'], 'integer'],
            [['file'],'file'],
            [['prod_name', 'prod_pic'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'prod_id' => Yii::t('app', 'Product ID'),
            'prod_name' => Yii::t('app', 'Product'),
            'cat_id' => Yii::t('app', 'Category'),
            'file' => Yii::t('app', 'Picture'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(Product_cat::className(), ['cat_id' => 'cat_id']);
    }
    
  
}
