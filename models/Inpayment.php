<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inpayment".
 *
 * @property integer $id
 * @property integer $date
 * @property integer $id_partner
 * @property string $sum
 * @property string $scan_plateg_src
 * @property string $nomer_1c
 * @property string $description
 */
class Inpayment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inpayment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'id_partner', 'sum', 'scan_plateg_src'], 'required'],
            [['date', 'id_partner'], 'integer'],
            [['sum'], 'number'],
            [['scan_plateg_src', 'description'], 'string', 'max' => 1000],
            [['nomer_1c'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'id_partner' => 'Id Partner',
            'sum' => 'Sum',
            'scan_plateg_src' => 'Scan Plateg Src',
            'nomer_1c' => 'Nomer 1c',
            'description' => 'Description',
        ];
    }
}
