<?php

namespace app\models\product;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property string $name
 * @property integer $id_type
 * @property string $short_name
 *
 * @property TypeProducts $idType
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_type'], 'integer'],
            [['name', 'short_name'], 'string', 'max' => 255],
            [['id_type'], 'exist', 'skipOnError' => true, 'targetClass' => TypeProducts::className(), 'targetAttribute' => ['id_type' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'id_type' => 'Id Type',
            'short_name' => 'Short Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(TypeProducts::className(), ['id' => 'id_type']);
    }
}
