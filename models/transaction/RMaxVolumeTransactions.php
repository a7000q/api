<?php

namespace app\models\transaction;

use Yii;

/**
 * This is the model class for table "r_max_volume_transactions".
 *
 * @property integer $id
 * @property integer $id_transaction
 * @property integer $date
 * @property string $volume
 */
class RMaxVolumeTransactions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r_max_volume_transactions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_transaction', 'volume'], 'required'],
            [['id_transaction'], 'integer'],
            [['volume'], 'number'],
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
            'volume' => 'Volume',
        ];
    }
}
