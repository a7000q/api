<?php

namespace app\controllers;

use Yii;
use app\models\cards\Cards;

class CardController extends CController
{
    public $modelClass = 'app\modules\api\api\models\Cards';

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['delete'], $actions['create'], $actions['update'], $actions['index']);

        return $actions;
    }

    public function actionTerminal($id_electro)
    {
        $card = Cards::findOne(['id_electro' => $id_electro]);

        if ($card)
            $r = $card->permissibleFuel(Yii::$app->user->identity->terminal->id_fuel_module);
        else
            $r['status'] = 1405;

        return $r;
    }
}