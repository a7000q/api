<?php

namespace app\models\transaction;

use Yii;

/**
 * This is the model class for table "r_return_transactions".
 *
 * @property integer $id
 * @property integer $id_transaction
 * @property integer $date
 * @property integer $volume
 */
class RReturnTransactions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r_return_transactions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_transaction', 'date', 'volume'], 'required'],
            [['id_transaction', 'date'], 'integer'],
            ['volume', 'number']
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
            'date' => 'Date',
            'volume' => 'Volume',
        ];
    }
}
