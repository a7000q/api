<?php

namespace app\controllers;

use app\models\product\Products;


class ProductsController extends CController
{
    public $modelClass = 'app\models\product\Products';

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['delete'], $actions['create'], $actions['update']);

        return $actions;
    }

    public function actionGetByType($id = false)
    {
        return Products::find()->where(['id_type' => $id])->all();
    }
}