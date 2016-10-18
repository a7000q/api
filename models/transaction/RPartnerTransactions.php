<?php

namespace app\models\transaction;

use Yii;

/**
 * This is the model class for table "r_partner_transactions".
 *
 * @property integer $id
 * @property integer $id_transaction
 * @property integer $id_partner
 * @property string $name_partner
 * @property string $sum
 */
class RPartnerTransactions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r_partner_transactions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_transaction', 'id_partner', 'name_partner'], 'required'],
            [['id_transaction', 'id_partner'], 'integer'],
            [['name_partner'], 'string', 'max' => 255],
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
            'id_partner' => 'Id Partner',
            'name_partner' => 'Name Partner',
        ];
    }
}
