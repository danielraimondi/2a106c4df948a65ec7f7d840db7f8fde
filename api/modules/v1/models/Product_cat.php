<?php

namespace api\modules\v1\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "product_cat".
 *
 * @property integer $cat_id
 * @property string $cat_name
 *
 * @property Product[] $products
 */
class Product_cat extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_cat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_name'], 'required'],
            [['cat_name'], 'string', 'max' => 32]
        ];
    }

    public static function primaryKey()
    {
        return ['cat_id'];
    }

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['cat_id' => 'cat_id']);
    }
}
