<?php

namespace app\models\transaction;

use Yii;

/**
 * This is the model class for table "r_price_discount_transactions".
 *
 * @property integer $id
 * @property integer $id_transaction
 * @property integer $id_price_discount
 * @property string $discount
 */
class RPriceDiscountTransactions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r_price_discount_transactions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_transaction', 'id_price_discount', 'discount'], 'required'],
            [['id_transaction', 'id_price_discount'], 'integer'],
            [['discount'], 'number'],
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
            'id_price_discount' => 'Id Price Discount',
            'discount' => 'Discount',
        ];
    }
}
