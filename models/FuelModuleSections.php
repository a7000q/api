<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fuel_module_sections".
 *
 * @property integer $id
 * @property integer $id_module
 * @property integer $name
 * @property double $volume
 * @property double $id_product
 * @property double $balance
 * @property double $balance_fact
 * @property double $last_price
 * @property double $last_density
 */
class FuelModuleSections extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fuel_module_sections';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_module', 'name', 'volume', 'id_product'], 'required'],
            [['id_module', 'name'], 'integer'],
            [['volume', 'id_product', 'balance', 'balance_fact', 'last_price', 'last_density'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_module' => 'Id Module',
            'name' => 'Name',
            'volume' => 'Volume',
            'id_product' => 'Id Product',
            'balance' => 'Balance',
            'balance_fact' => 'Balance Fact',
            'last_price' => 'Last Price',
            'last_density' => 'Last Density',
        ];
    }
}
