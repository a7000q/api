<?php

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord  implements \yii\web\IdentityInterface
{
    public static function tableName()
    {
        return 'azs_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_terminal', 'login', 'password'], 'required'],
            [['id_terminal', 'date'], 'integer'],
            [['login', 'name', 'surname'], 'string', 'max' => 255],
            [['password', 'token'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_terminal' => 'Id Terminal',
            'login' => 'Login',
            'password' => 'Password',
            'token' => 'Token',
            'date' => 'Date',
            'name' => 'Name',
            'surname' => 'Surname',
        ];
    }


    public function fields()
    {
        $fields = parent::fields();

        unset($fields["password"]);

        return $fields;
    }


    public static function findIdentityByAccessToken($token, $type = null)
    {
        if ($token != "")
            return static::findOne(['token' => $token]);
        else
            return false;
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function auth($id_terminal)
    {
        $this->id_terminal = $id_terminal;
        $this->date = time();
        $this->token = md5($this->date.$id_terminal.$this->login.$this->password);

        $this->save();
    }

    public function reAuth()
    {
        $this->date = time();
        $this->token = md5($this->date.$this->id_terminal.$this->login.$this->password);

        $this->save();
    }

    public function logout()
    {
        $this->token = "";
        $this->id_terminal = 0;
        $this->save();
    }

    public function getTerminal()
    {
        return $this->hasOne(Terminal::className(), ['id' => 'id_terminal']);
    }
}
