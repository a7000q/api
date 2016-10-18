<?php

namespace app\models\transaction;

use Yii;

/**
 * This is the model class for table "r_module_status_transactions".
 *
 * @property integer $id
 * @property integer $id_transaction
 * @property integer $date
 * @property integer $type
 */
class RModuleStatusTransactions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r_module_status_transactions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_transaction', 'date'], 'required'],
            [['id_transaction', 'date', 'type'], 'integer'],
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
            'type' => 'Type',
        ];
    }
}
