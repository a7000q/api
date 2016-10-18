<?php

namespace app\models\transaction;

use Yii;
use app\models\Cards;

/**
 * This is the model class for table "r_card_transactions".
 *
 * @property integer $id
 * @property integer $id_transaction
 * @property integer $id_card
 * @property string $name_card
 */
class RCardTransactions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r_card_transactions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_transaction', 'id_card', 'name_card'], 'required'],
            [['id_transaction', 'id_card'], 'integer'],
            [['name_card'], 'string', 'max' => 255],
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
            'id_card' => 'Id Card',
            'name_card' => 'Name Card',
        ];
    }

    public function getCard()
    {
        return $this->hasOne(Cards::className(), ['id' => 'id_card']);
    }
}
