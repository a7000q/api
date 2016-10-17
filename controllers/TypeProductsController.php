<?php

namespace app\controllers;


class TypeProductsController extends CController
{
    public $modelClass = 'app\models\product\TypeProducts';

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['delete'], $actions['create'], $actions['update']);

        return $actions;
    }




}