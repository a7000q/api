<?php

namespace app\models\price;

use Yii;
use app\models\product\Products;
use app\models\product\TypeProducts;

/**
 * This is the model class for table "azs_price".
 *
 * @property integer $id
 * @property integer $id_product
 * @property integer $id_module
 * @property integer $id_type
 * @property string $price
 */
class AzsPrice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'azs_price';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_product', 'id_module', 'id_type', 'price'], 'required'],
            [['id_product', 'id_module', 'id_type'], 'integer'],
            [['price'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_product' => 'Id Product',
            'id_module' => 'Id Module',
            'id_type' => 'Id Type',
            'price' => 'Price',
        ];
    }

    public function extraFields()
    {
        return ['product', 'typeProduct'];
    }

    static public function updatePrice($id_module, $id_product, $price)
    {
        $product = Products::findOne($id_product);

        if (!$product)
            return ["status" => 1404];

        $id_type = $product->id_type;

        $azs_price = static::findOne(['id_module' => $id_module, 'id_type' => $id_type]);

        if ($azs_price)
        {
            $azs_price->price = $price;
            $azs_price->id_type = $id_type;
        }
        else
        {
            $azs_price = new AzsPrice();
            $azs_price->id_module = $id_module;
            $azs_price->id_product = $id_product;
            $azs_price->id_type = $id_type;
            $azs_price->price = $price;
        }

        if ($azs_price->validate())
            $azs_price->save();
        else
            return ['status' => 1409];
    }

    public function getProductLink()
    {
        return $this->hasOne(Products::className(), ['id' => 'id_product']);
    }

    public function getProduct()
    {
        return $this->productLink->name;
    }

    public function getTypeProductLink()
    {
        return $this->hasOne(TypeProducts::className(), ['id' => 'id_type']);
    }

    public function getTypeProduct()
    {
        return $this->typeProductLink->name;
    }
}
