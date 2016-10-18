<?php

namespace app\models\transaction;

use Yii;

/**
 * This is the model class for table "r_terminal_transaction".
 *
 * @property integer $id
 * @property integer $id_transaction
 * @property integer $id_terminal
 * @property string $name
 */
class RTerminalTransactions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r_terminal_transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_transaction', 'id_terminal', 'name'], 'required'],
            [['id_transaction', 'id_terminal'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'id_terminal' => 'Id Terminal',
            'name' => 'Name',
        ];
    }
}
