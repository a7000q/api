<?php

namespace app\models\cards;

use Yii;
use app\models\price\AzsPrice;
use yii\helpers\ArrayHelper;
use app\models\transaction\Transactions;
use app\models\Partners;
use app\models\TypeLimit;

/**
 * This is the model class for table "cards".
 *
 * @property integer $id
 * @property integer $id_txt
 * @property string $id_electro
 * @property integer $id_partner
 * @property integer $id_type_limit
 * @property integer $id_type_measurement_limit
 * @property integer $value_limit
 * @property string $name
 * @property string $type
 */
class Cards extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cards';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_txt', 'id_partner', 'id_type_limit', 'id_type_measurement_limit', 'value_limit', 'type'], 'integer'],
            [['id_electro', 'id_partner', 'name'], 'required'],
            [['id_electro'], 'string', 'max' => 100],
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
            'id_txt' => 'Id Txt',
            'id_electro' => 'Id Electro',
            'id_partner' => 'Id Partner',
            'id_type_limit' => 'Id Type Limit',
            'id_type_measurement_limit' => 'Id Type Measurement Limit',
            'value_limit' => 'Value Limit',
            'name' => 'Name',
            'type' => 'Type',
        ];
    }

    public function permissibleFuel($id_module)
    {
        $type_products = $this->accessCardTypeProduct;

        $prices = AzsPrice::find()->where(['id_module' => $id_module]);

        if ($type_products)
        {
            $types = ArrayHelper::map($type_products, 'id', 'id_type_product');

            $prices = $prices->andWhere(['in', 'id_type', $types]);
        }

        $prices= ArrayHelper::toArray($prices->all(), [
            AzsPrice::className() => [
                'id',
                'typeProduct',
                'price',
                'id_product'
            ]
        ]);

        $result['card']['name'] = $this->name;
        $result['card']['partner_name'] = $this->partner->name;
        $result['prices'] = $prices;

        return $result;
    }

    public function getAccessCardTypeProduct()
    {
        return $this->hasMany(AccessCardTypeProduct::className(), ['id_card' => 'id']);
    }


    //Получить разрешение на заправку по типу топлива
    //$id_product - тип топлива
    public function validTypeProduct($id_type_product)
    {
        if (!$this->accessCardTypeProduct)
            return true;

        $access = AccessCardTypeProduct::findOne(['id_card' => $this->id, 'id_type_product' => $id_type_product]);

        if ($access)
            return true;

        return false;
    }

    //Получить суммарный обьем доступный для запрвки на АЗС
    //$id_price - идентификатор обьекта AzsPrice
    public function validSumVolume($id_type_product, $price)
    {
        if (!$this->validTypeProduct($id_type_product))
            return 0;

        $partner = $this->partner;

        $sum_volume = ($partner->balancePost + $partner->limit)/$price;

        if ($this->typeLimit)
        {
            $limit = $this->getSumVolumeLimit($price);

            if ($limit <= $sum_volume)
                return $limit;
        }

        return $sum_volume;
    }

    //Получить остаток литров по установленному лимиту
    //$price - цена за литр
    public function getSumVolumeLimit($price)
    {
        $period = $this->typeLimit->period;

        $trans_sum = Transactions::find()->joinWith('cardTransaction')->where(['id_card' => $this->id])->andWhere(['>=', 'date', $period["start"]])->andWhere(['<=', 'date', $period["end"]])->sum('volume');

        switch ($this->id_type_measurement_limit)
        {
            case 1:
                return $this->value_limit - $trans_sum;
                break;

            case 2:
                $sum = $this->value_limit - $trans_sum;

                $volume = $sum/$price;

                return $volume;
                break;

            default:
                return 0;
                break;
        }
    }

    public function getPartner()
    {
        return $this->hasOne(Partners::className(), ['id' => 'id_partner']);
    }

    public function getTypeLimit()
    {
        return $this->hasOne(TypeLimit::className(), ['id' => 'id_type_limit']);
    }

}
