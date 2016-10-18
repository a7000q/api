<?php

namespace app\models\transaction;

use Yii;
use app\models\FuelModule;


class RModuleTransactions extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'r_module_transactions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_transaction', 'id_module', 'name_module'], 'required'],
            [['id_transaction', 'id_module'], 'integer'],
            [['name_module'], 'string']
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
            'id_module' => 'Id Module',
            'name_module' => 'Name Module',
        ];
    }

    public function getModule()
    {
        return $this->hasOne(FuelModule::className(), ['id' => 'id_module']);
    }
}
