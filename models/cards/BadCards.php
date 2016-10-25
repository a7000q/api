<?php

namespace app\models\cards;

use Yii;

/**
 * This is the model class for table "bad_cards".
 *
 * @property integer $id
 * @property integer $date
 * @property string $id_electro
 * @property integer $id_terminal
 */
class BadCards extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bad_cards';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'id_terminal'], 'integer'],
            [['id_electro'], 'string'],
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
            'id_electro' => 'Id Electro',
            'id_terminal' => 'Id Terminal',
        ];
    }
}
