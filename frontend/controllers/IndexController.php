<?php

namespace frontend\controllers;

use backend\models\Goods;
use backend\models\GoodsClass;

class IndexController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }




}
