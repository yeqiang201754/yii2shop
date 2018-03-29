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
       public function actionList($id){
     //   $goods1=GoodsClass::find()->where(['p_id'=>$id])->all();
             $goods=Goods::find()->where(['goods_class_id'=>$id])->all();


             return $this->render('list',compact('goods'));
       }
}
