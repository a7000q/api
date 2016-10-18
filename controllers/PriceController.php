<?php

namespace app\controllers;

use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use app\models\Terminal;
use Yii;
use app\models\price\AzsPrice;


class PriceController extends CController
{
    public $modelClass = 'app\models\price\AzsPrice';

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['delete'], $actions['index'], $actions['update']);

        return $actions;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['except'] = ['all'];

        return $behaviors;

    }

    public function actionEdit($id_product, $price)
    {
        return AzsPrice::updatePrice(Yii::$app->user->identity->terminal->id_fuel_module, $id_product, $price);
    }

    public function actionAll($id_terminal)
    {
        $terminal = Terminal::findOne($id_terminal);
        if (!$terminal)
            return ['status' => 1401];

        $id_module = $terminal->id_fuel_module;
        $AzsPrice = AzsPrice::find()->where(['id_module' => $id_module]);
        return new ActiveDataProvider(['query' => $AzsPrice]);
    }
}