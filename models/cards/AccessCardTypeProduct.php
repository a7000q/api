<?php

namespace app\models\cards;

use Yii;

/**
 * This is the model class for table "access_card_type_product".
 *
 * @property integer $id
 * @property integer $id_card
 * @property integer $id_type_product
 */
class AccessCardTypeProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'access_card_type_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_card', 'id_type_product'], 'required'],
            [['id_card', 'id_type_product'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_card' => 'Id Card',
            'id_type_product' => 'Id Type Product',
        ];
    }
}
