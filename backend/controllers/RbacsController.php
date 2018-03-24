<?php
/**
 * Created by PhpStorm.
 * User: yeqiang
 * Date: 2018/3/24
 * Time: 18:17
 */

namespace backend\controllers;


use yii\web\Controller;

class RbacsController extends Controller
{
       public function behaviors()
       {
           return [
            'rbac'=>[
                'class'=>RbacsController::className()
            ]


           ];
       }
}