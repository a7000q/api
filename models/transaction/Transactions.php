<?php

namespace app\models\transaction;

use Yii;
use app\models\transaction\RCardTransactions;
use app\models\transaction\RPartnerTransactions;
use app\models\transaction\RProductTransactions;
use app\models\transaction\RModuleTransactions;
use app\models\transaction\RModuleSectionTransactions;
use app\models\transaction\RTerminalTransactions;
use app\models\transaction\RPriceDiscountTransactions;
use app\models\transaction\RReturnTransactions;
use app\models\transaction\RTypeProductTransactions;
use app\models\transaction\RMaxVolumeTransactions;
use app\models\transaction\RModuleStatusTransactions;
use app\models\transaction\RPriceTransactions;
use app\models\cards\Cards;
use app\models\Partners;
use app\models\FuelModule;
use app\models\FuelModuleSections;
use app\models\product\Products;
use app\models\Terminal;
use app\models\PricesDiscounts;
use app\models\product\TypeProducts;
use app\models\price\AzsPrice;



class Transactions extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'transactions';
    }

    public function rules()
    {
        return [
            [['date', 'id_type', 'volume'], 'required'],
            [['date', 'id_type'], 'integer'],
            [['volume'], 'number'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'id_type' => 'Id Type',
            'volume' => 'Volume',
        ];
    }

    public function addCardTransaction($id_card)
    {
        $card = Cards::findOne($id_card);

        if (!$card)
            return false;

        $card_transaction = new RCardTransactions();
        $card_transaction->id_transaction = $this->id;
        $card_transaction->id_card = $id_card;
        $card_transaction->name_card = $card->name;

        if ($card_transaction->validate())
            $card_transaction->save();
        else
            return false;

        $this->addPartnerTransaction($card->id_partner);

        return true;
    }

    public function addPartnerTransaction($id_partner)
    {
        $partner = Partners::findOne($id_partner);

        if (!$partner)
            return false;

        $partner_transaction = new RPartnerTransactions();
        $partner_transaction->id_transaction = $this->id;
        $partner_transaction->id_partner = $id_partner;
        $partner_transaction->name_partner = $partner->name;

        if ($partner_transaction->validate())
            $partner_transaction->save();
        else
            return false;

        return true;
    }

    public function addModuleTransaction($id_module)
    {
        $module = FuelModule::findOne($id_module);

        if (!$module)
            return false;

        $module_transaction = new RModuleTransactions();
        $module_transaction->id_transaction = $this->id;
        $module_transaction->id_module = $id_module;
        $module_transaction->name_module = $module->name;

        if ($module_transaction->validate())
            $module_transaction->save();
        else
            return false;

        return true;
    }

    public function addModuleSectionTransaction($id_module_section)
    {
        $module_section = FuelModuleSections::findOne($id_module_section);

        if (!$module_section)
            return false;

        $module_section_transaction = new RModuleSectionTransactions();
        $module_section_transaction->id_transaction = $this->id;
        $module_section_transaction->id_section = $id_module_section;
        $module_section_transaction->name_section = (string)$module_section->name;

        if ($module_section_transaction->validate())
            $module_section_transaction->save();
        else
            return false;

        $this->addModuleTransaction($module_section->id_module);

        return true;
    }

    public function addProductTransaction($id_product, $price)
    {
        $product = Products::findOne($id_product);

        if (!$product)
            return false;

        $product_transaction = new RProductTransactions();
        $product_transaction->id_transaction = $this->id;
        $product_transaction->id_product = $id_product;
        $product_transaction->name_product = $product->name;
        $product_transaction->price = $price;

        if ($product_transaction->validate())
            $product_transaction->save();
        else
            return false;

        $this->addTypeProductTransaction($product->id_type);

        return true;
    }

    public function addTerminalTransaction($id_terminal)
    {
        $terminal = Terminal::findOne($id_terminal);

        if (!$terminal)
            return false;

        $terminal_transaction = new RTerminalTransactions();
        $terminal_transaction->id_transaction = $this->id;
        $terminal_transaction->id_terminal = $id_terminal;
        $terminal_transaction->name = $terminal->name;

        if ($terminal_transaction->validate())
            $terminal_transaction->save();
        else
            return false;

        return true;
    }

    public function addPriceDiscountTransaction($price_discount)
    {
        if (!$price_discount)
            return false;

        $price_discount_transaction = new RPriceDiscountTransactions();
        $price_discount_transaction->id_transaction = $this->id;
        $price_discount_transaction->id_price_discount = $price_discount->id;
        $price_discount_transaction->discount = $price_discount->discount;

        if ($price_discount_transaction->validate())
            $price_discount_transaction->save();
        else
            return false;

        return true;
    }

    public function addReturnTransaction($volume)
    {
        $return_transaction = new RReturnTransactions();
        $return_transaction->id_transaction = $this->id;
        $return_transaction->date = time();
        $return_transaction->volume = $this->volume;

        if ($return_transaction->validate())
        {
            $return_transaction->save();
            $this->volume = $volume;
            $this->save();
        }
        else
            return false;

        return true;
    }

    public function addTypeProductTransaction($id_type_product)
    {
        $type_product = TypeProducts::findOne($id_type_product);

        if (!$type_product)
            return false;

        $type_product_transaction = new RTypeProductTransactions();
        $type_product_transaction->id_transaction = $this->id;
        $type_product_transaction->id_type_product = $id_type_product;
        $type_product_transaction->name_type_product = $type_product->name;

        if ($type_product_transaction->validate())
            $type_product_transaction->save();
        else
            return false;

        return true;
    }

    public function addMaxVolumeTransaction($volume)
    {
        $max_volume_transaction = new RMaxVolumeTransactions();
        $max_volume_transaction->id_transaction = $this->id;
        $max_volume_transaction->volume = $volume;

        if ($max_volume_transaction->validate())
            $max_volume_transaction->save();
        else
            return false;

        return true;
    }

    public function addModuleStatusTransaction()
    {
        $module_status_transaction = new RModuleStatusTransactions();
        $module_status_transaction->id_transaction = $this->id;
        $module_status_transaction->date = $this->date;
        $module_status_transaction->type = 1;

        if ($module_status_transaction->validate())
            $module_status_transaction->save();
        else
            return false;

        return true;
    }

    public function addPriceTransaction($id_price)
    {
        $price_table = Prices::findOne($id_price);

        $price_transaction = new RPriceTransactions();
        $price_transaction->id_transaction = $this->id;
        $price_transaction->id_price = $id_price;
        $price_transaction->id_type = $price_table->id_type;
        $price_transaction->price = $price_table->price;

        if ($price_transaction->validate())
            $price_transaction->save();
        else
            return false;

        return true;
    }

    public function getCardTransaction()
    {
        return $this->hasOne(RCardTransactions::className(), ['id_transaction' => 'id']);
    }

    public function getPartnerTransaction()
    {
        return $this->hasOne(RPartnerTransactions::className(), ['id_transaction' => 'id']);
    }

    public function getModuleTransaction()
    {
        return $this->hasOne(RModuleTransactions::className(), ['id_transaction' => 'id']);
    }

    public function getModuleSectionTransaction()
    {
        return $this->hasOne(RModuleSectionTransactions::className(), ['id_transaction' => 'id']);
    }

    public function getProductTransaction()
    {
        return $this->hasOne(RProductTransactions::className(), ['id_transaction' => 'id']);
    }

    public function getTerminalTransaction()
    {
        return $this->hasOne(RTerminalTransactions::className(), ['id_transaction' => 'id']);
    }

    public function getPriceDiscountTransaction()
    {
        return $this->hasOne(RPriceDiscountTransactions::className(), ['id_transaction' => 'id']);
    }

    public function getReturnTransaction()
    {
        return $this->hasOne(RReturnTransactions::className(), ['id_transaction' => 'id'])->orderBy('date DESC');
    }

    public function getTypeProductTransaction()
    {
        return $this->hasOne(RTypeProductTransactions::className(), ['id_transaction' => 'id']);
    }

    public function getMaxVolumeTransaction()
    {
        return $this->hasOne(RMaxVolumeTransactions::className(), ['id_transaction' => 'id']);
    }

    public function getModuleStatusTransaction()
    {
        return $this->hasOne(RModuleStatusTransactions::className(), ['id_transaction' => 'id']);
    }

    public function getPriceTransaction()
    {
        return $this->hasOne(RPriceTransactions::className(), ['id_transaction' => 'id']);
    }


    public function beforeDelete()
    {
        if (parent::beforeDelete()) 
        {
            if ($this->cardTransaction)
                $this->cardTransaction->delete();

            if ($this->partnerTransaction)
                $this->partnerTransaction->delete();

            if ($this->moduleTransaction)
                $this->moduleTransaction->delete(); 

            if ($this->moduleSectionTransaction)
                $this->moduleSectionTransaction->delete();

            if ($this->productTransaction)
                $this->productTransaction->delete();

            if ($this->terminalTransaction)
                $this->terminalTransaction->delete();

            if ($this->priceDiscountTransaction)
                $this->priceDiscountTransaction->delete();

            if ($this->typeProductTransaction)
                $this->typeProductTransaction->delete();

            if ($this->priceDiscountTransaction)
                $this->priceDiscountTransaction->delete();

            if ($this->maxVolumeTransaction)
                $this->maxVolumeTransaction->delete();

            if ($this->returnTransaction)
                RReturnTransactions::deleteAll(['id_transaction' => $this->id]);

            if ($this->moduleStatusTransaction)
                $this->moduleStatusTransaction->delete();

            if ($this->priceTransaction)
                $this->priceTransaction->delete();

            return true;
        }
        else
            return false;
    }

    public function extraFields()
    {
        return ['cardNumber', 'typeProduct', 'cardName', 'lastTransactionVolume', 'partnerName'];
    }

    //Добавить транзакцию с проверкой на доступность заправки картой данного топлива
    public function add($id_terminal, $id_electro, $id_price, $volume)
    {
        $card = Cards::findOne(['id_electro' => $id_electro]);
        $price = AzsPrice::findOne($id_price);
        $module = FuelModule::findOne($price->id_module);

        if (!$card)
            return ['status' => 1405];

        $valid_sum = $card->validSumVolume($price->id_type, $price->price);


        if ($volume > $valid_sum)
            return ['status' => 1408, 'data' => ['volume' => $valid_sum]];

        $this->date = time();
        $this->id_type = 1;
        $this->volume = $volume;

        if ($this->validate())
        {
            $this->save();

            $this->addCardTransaction($card->id);
            $this->addModuleTransaction($module->id);
            $this->addProductTransaction($price->id_product, $price->price);
            $this->addPriceDiscountTransaction($card->partner->pricesDiscounts);
            $this->addTerminalTransaction($id_terminal);
        }

        return $this;
    }

    //Возврат по транзакции
    public function returnT($volume)
    {
        if ($this->volume < $volume)
            return ['status' => 1411];

        $this->addReturnTransaction($volume);

        return $this;
    }

    public function getCardNumber()
    {
        if ($this->cardTransaction)
            return $this->cardTransaction->card->id_txt;
    }

    public function getTypeProduct()
    {
        if ($this->typeProductTransaction)
            return $this->typeProductTransaction->name_type_product;
    }

    public function getCardName()
    {
        if ($this->cardTransaction)
            return $this->cardTransaction->name_card;
    }

    public function getLastTransactionVolume()
    {
        if ($this->returnTransaction)
            return $this->returnTransaction->volume;

        return 0;
    }

    public function getPartnerName()
    {
        if ($this->partnerTransaction)
            return $this->partnerTransaction->name_partner;
    }
}
