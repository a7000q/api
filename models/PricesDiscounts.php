<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prices_discounts".
 *
 * @property integer $id
 * @property integer $id_partner
 * @property string $discount
 */
class PricesDiscounts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prices_discounts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_partner', 'discount'], 'required'],
            [['id_partner'], 'integer'],
            [['discount'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_partner' => 'Id Partner',
            'discount' => 'Discount',
        ];
    }
}
