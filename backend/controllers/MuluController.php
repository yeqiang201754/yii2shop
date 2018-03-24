<?php

namespace backend\controllers;

use backend\models\Mulu;
use yii\helpers\ArrayHelper;

class MuluController extends \yii\web\Controller
{
    /**显示
     * @return string
     */
    public function actionIndex()
    {
        $mu=Mulu::find()->all();

        return $this->render('index',compact('mu'));
    }

    /**添加
     * @return string|\yii\web\Response
     */
public function actionInsert(){
       $model=new Mulu();
       $mus=Mulu::find()->all();
        $mus[]=['name'=>'顶级分类 ','id'=>'0'];
       $mus=ArrayHelper::map($mus,'id','name');
      // $mus[]=[0=>'askjdkjasd '];
    if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
        if ($model->save()) {
            \Yii::$app->session->setFlash('success','添加成功');
            return $this->redirect(['insert']);
        }
    }
       return $this->render('insert',compact('model','mus'));
}

    /**修改
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id){
        $model=Mulu::findOne($id);
        $mus=Mulu::find()->all();
        $mus[]=['name'=>'顶级分类 ','id'=>'0'];
        $mus=ArrayHelper::map($mus,'id','name');
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            if ($model->save()) {
                \Yii::$app->session->setFlash('success','添加成功');
                return $this->redirect(['index']);
            }
        }
        return $this->render('insert',compact('model','mus'));
    }

    /**删除
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDelete($id){
       $mu=Mulu::findOne($id);
        if ($mu->delete()) {
            \Yii::$app->session->setFlash('success','删除成功');
            return $this->redirect(['index']);
        }



    }
}
