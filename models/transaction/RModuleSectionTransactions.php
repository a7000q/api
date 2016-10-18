<?php

namespace app\models\transaction;

use Yii;
use app\models\FuelModuleSections;

class RModuleSectionTransactions extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'r_module_section_transactions';
    }

    public function rules()
    {
        return [
            [['id_transaction', 'id_section', 'name_section'], 'required'],
            [['id_transaction', 'id_section'], 'integer'],
            [['name_section'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_transaction' => 'Id Transaction',
            'id_section' => 'Id Section',
            'name_section' => 'Name Section',
        ];
    }


    public function getModuleSection()
    {
        return $this->hasOne(FuelModuleSections::className(), ['id' => 'id_section']);
    }
}
