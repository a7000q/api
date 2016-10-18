<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\transaction\Transactions;

/**
 * This is the model class for table "photos".
 *
 * @property integer $id
 * @property integer $id_tranzaction
 * @property string $src
 */
class Photos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $file;


    public static function tableName()
    {
        return 'photos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_transaction', 'src'], 'required'],
            [['id_transaction'], 'integer'],
            [['src'], 'string', 'max' => 1000],
            [['file'], 'file']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_transaction' => 'Id Tranzaction',
            'src' => 'Src',
        ];
    }

    public function upload()
    {
        if ($this->hasTransaction())
        {
            $srcFile = $this->srcFile;
            $srcFile .= $this->file->baseName . '.' . $this->file->extension;
            $this->src = $srcFile;
            if ($this->validate()) {
                $this->file->saveAs($srcFile);
                $this->save();
                return true;
            } else {
                return false;
            }
        }
        else
            return false;
        
        //print_r($this->file);
        //die();
    }

    public function hasTransaction()
    {
        $Transaction = Transactions::findOne($this->id_transaction);

        if ($Transaction)
            return true;
        else
            return false;
    }

    public function getTransaction()
    {
        return $this->hasOne(Transactions::className(), ['id' => 'id_transaction']);
    }

    public function getSrcFile()
    {
        $src = "uploads/photos/".$this->transaction->partnerTransaction->id_partner."/";

        if (!file_exists($src))
            mkdir($src);

        $src .= $this->transaction->cardTransaction->id_card."/";

        if (!file_exists($src))
            mkdir($src);

        $src .= $this->id_transaction."/";
        if (!file_exists($src))
            mkdir($src);


        return $src;
    }
}
