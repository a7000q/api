<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fuel_module".
 *
 * @property integer $id
 * @property integer $id_type_station
 * @property string $name
 * @property string $address
 * @property string $coords
 */
class FuelModule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fuel_module';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_type_station'], 'integer'],
            [['name', 'address', 'coords'], 'required'],
            [['name'], 'string', 'max' => 1000],
            [['address'], 'string', 'max' => 2000],
            [['coords'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_type_station' => 'Id Type Station',
            'name' => 'Name',
            'address' => 'Address',
            'coords' => 'Coords',
        ];
    }
}
