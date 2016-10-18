<?php

namespace app\models\transaction;

use Yii;
use app\models\Prices;
use app\models\transaction\Transactions;
use app\models\transaction\RPartnerTransactions;

/**
 * This is the model class for table "r_product_transactions".
 *
 * @property integer $id
 * @property integer $id_transaction
 * @property integer $id_product
 * @property integer $name_product
 * @property string $price
 */
class RProductTransactions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r_product_transactions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_transaction', 'id_product', 'name_product', 'price'], 'required'],
            [['id_transaction', 'id_product'], 'integer'],
            [['name_product'], 'string'],
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
            'id_product' => 'Id Product',
            'name_product' => 'Name Product',
            'price' => 'Price',
        ];
    }

    public function getPriceTable()
    {
        return $this->hasOne(Prices::className(), ['id_product' => 'id_product']);
    }

    public function getTransaction()
    {
        return $this->hasOne(Transactions::className(), ['id' => 'id_transaction']);
    }
}
