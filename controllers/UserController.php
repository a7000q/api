<?php

namespace app\controllers;

use app\models\Terminal;
use app\models\User;
use Yii;

class UserController extends CController
{
    public $modelClass = 'app\models\User';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['except'] = ['login'];

        return $behaviors;

    }

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['delete'], $actions['create'], $actions['index'], $actions['update'], $actions['view']);

        return $actions;
    }


    public function actionLogin($id_terminal, $login, $password)
    {
        if (!Terminal::findOne($id_terminal))
            return ['status' => 1401];

        $user = User::findOne(['login' => $login, 'password' => md5($password)]);

        if (!$user)
            return ['status' => 1400];

        if (User::findOne(['id_terminal' => $id_terminal]))
            return ['status' => 1402];

        if ($user->token != "")
            return ['status' => 1403];

        $user->auth($id_terminal);

        return $user;
    }

    public function actionLogout()
    {
        $user = Yii::$app->user->identity;
        return $user->logout();
    }
}