<?php

namespace app\controllers;

use app\models\transaction\Transactions;
use Yii;
use app\models\cards\Cards;
use app\models\Photos;
use yii\web\UploadedFile;

class TransactionsController extends CController
{
    public $modelClass = 'app\models\transaction\Transactions';

    public function actionSpend($id_electro, $id_price, $volume)
    {
        $transactions = new Transactions();
        $transactions = $transactions->add(Yii::$app->user->identity->id_terminal, $id_electro, $id_price, $volume);
        return $transactions;
    }

    public function actionReturn($id_electro, $volume)
    {
        $card = Cards::findOne(['id_electro' => $id_electro]);

        if (!$card)
            return ['status' => 1405];

        $transaction = Transactions::find()->joinWith('cardTransaction')->joinWith('terminalTransaction')->where(['id_terminal' => Yii::$app->user->identity->id_terminal])->andWhere(['id_card' => $card->id])->orderBy('date DESC')->one();

        if (!$transaction)
            return ['status' => 1410];

        return $transaction->returnT($volume);
    }

    public function actionSendImage()
    {
        $post = Yii::$app->request->post();

        if (!isset($post["id_transaction"]))
            return ['status' => 1412];

        $photo = new Photos();
        $photo->id_transaction = $post["id_transaction"];
        $photo->file = UploadedFile::getInstanceByName('imageFile');

        if (!$photo->upload())
            return ['status' => 1413];

        return ['status' => 200];
    }

    public function actionLast($id_electro)
    {
        $card = Cards::findOne(['id_electro' => $id_electro]);

        if (!$card)
            return ['status' => 1405];

        $transaction = Transactions::find()->joinWith('cardTransaction')->joinWith('terminalTransaction')->where(['id_terminal' => Yii::$app->user->identity->id_terminal])->andWhere(['id_card' => $card->id])->orderBy('date DESC')->one();

        return $transaction;
    }

    public function actionDeleteTest()
    {
        $cards = ['1', '532', '483'];

        $transactions = Transactions::find()->joinWith('cardTransaction')->where(['in', 'id_card', $cards])->all();

        foreach ($transactions as $t)
            $t->delete();

        return "ok";

    }
}