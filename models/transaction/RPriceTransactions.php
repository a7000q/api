<?php

namespace app\models\transaction;

use Yii;

/**
 * This is the model class for table "r_price_transactions".
 *
 * @property integer $id
 * @property integer $id_transaction
 * @property integer $id_price
 * @property integer $id_type
 * @property string $price
 */
class RPriceTransactions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r_price_transactions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_transaction', 'id_price', 'id_type', 'price'], 'required'],
            [['id_transaction', 'id_price', 'id_type'], 'integer'],
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
            'id_transaction' => 'Id Transaction',
            'id_price' => 'Id Price',
            'id_type' => 'Id Type',
            'price' => 'Price',
        ];
    }
}
