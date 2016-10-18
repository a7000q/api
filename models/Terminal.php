<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "api_terminal".
 *
 * @property integer $id
 * @property string $name
 * @property string $imei
 */
class Terminal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'terminals';
    }

}
