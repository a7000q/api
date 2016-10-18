<?php

namespace app\models\transaction;

use Yii;
use app\models\TypeProducts;

/**
 * This is the model class for table "r_type_product_transactions".
 *
 * @property integer $id
 * @property integer $id_transaction
 * @property integer $id_type_product
 * @property string $name_type_product
 */
class RTypeProductTransactions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r_type_product_transactions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_transaction', 'id_type_product', 'name_type_product'], 'required'],
            [['id_transaction', 'id_type_product'], 'integer'],
            [['name_type_product'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_transaction' => 'Id Transaction',
            'id_type_product' => 'Id Type Product',
            'name_type_product' => 'Name Type Product',
        ];
    }

    public function getTypeProduct()
    {
        return $this->hasOne(TypeProducts::className(), ['id' => 'id_type_product']);
    }
}
