<?php

namespace app\models;

use Yii;
use app\models\PricesDiscounts;
use app\models\transaction\Transactions;

/**
 * This is the model class for table "partners".
 *
 * @property integer $id
 * @property string $inn
 * @property string $full_name
 * @property string $address
 * @property string $fakt_address
 * @property string $pravo_forma
 * @property string $name
 * @property string $kpp
 * @property string $ogrn
 * @property string $okved
 * @property string $okato
 * @property string $oktmo
 * @property string $okogu
 * @property string $okfs
 * @property string $okopf
 * @property string $okpo
 * @property string $email
 * @property string $phone
 * @property string $director
 * @property string $osnovanie
 * @property string $phoneSms
 * @property string $balance
 * @property integer $my
 * @property string $limit
 */
class Partners extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partners';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['inn', 'full_name', 'address', 'fakt_address', 'pravo_forma', 'name', 'kpp', 'ogrn', 'okved', 'okato', 'oktmo', 'okogu', 'okfs', 'okopf', 'okpo', 'email', 'phone', 'director', 'osnovanie', 'phoneSms'], 'required'],
            [['balance', 'limit'], 'number'],
            [['my'], 'integer'],
            [['inn', 'kpp', 'ogrn', 'okato', 'oktmo', 'okogu', 'okfs', 'okopf', 'okpo'], 'string', 'max' => 20],
            [['full_name', 'address', 'fakt_address', 'name', 'okved', 'email', 'phoneSms'], 'string', 'max' => 1000],
            [['pravo_forma'], 'string', 'max' => 10],
            [['phone'], 'string', 'max' => 100],
            [['director', 'osnovanie'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'inn' => 'Inn',
            'full_name' => 'Full Name',
            'address' => 'Address',
            'fakt_address' => 'Fakt Address',
            'pravo_forma' => 'Pravo Forma',
            'name' => 'Name',
            'kpp' => 'Kpp',
            'ogrn' => 'Ogrn',
            'okved' => 'Okved',
            'okato' => 'Okato',
            'oktmo' => 'Oktmo',
            'okogu' => 'Okogu',
            'okfs' => 'Okfs',
            'okopf' => 'Okopf',
            'okpo' => 'Okpo',
            'email' => 'Email',
            'phone' => 'Phone',
            'director' => 'Director',
            'osnovanie' => 'Osnovanie',
            'phoneSms' => 'Phone Sms',
            'balance' => 'Balance',
            'my' => 'My',
            'limit' => 'Limit',
        ];
    }

    public function getPricesDiscounts()
    {
        return $this->hasOne(PricesDiscounts::className(), ['id_partner' => 'id']);
    }

    public function getSumInpayments()
    {
        return Inpayment::find()->where(['id_partner' => $this->id])->sum('sum');
    }

    public function getSumTransactions()
    {
        $sum = Transactions::find()->joinWith('partnerTransaction')->joinWith('productTransaction')->where(['r_partner_transactions.id_partner' => $this->id])->sum('r_product_transactions.price*volume');

        return $sum;
    }

    public function getBalancePost()
    {
        return $this->sumInpayments - $this->sumTransactions;
    }

}
