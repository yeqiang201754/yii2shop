<?php

namespace backend\controllers;

use backend\models\DeliveryWay;

class DeliveryWayController extends \yii\web\Controller
{

    /**查看
     * @return string
     */
    public function actionIndex()
    {

        $models=DeliveryWay::find()->all();
        return $this->render('index',compact('models'));
    }

    /**添加
     * @return string|\yii\web\Response
     */


    public function actionInsert(){
       $model=new DeliveryWay();
       $request=\Yii::$app->request;
        if ($request->isPost) {
           $model->load($request->post());
            if ($model->validate()) {
                if ($model->save()) {
                    \Yii::$app->session->setFlash('success','添加成功');
                    return $this->redirect(['insert']);
                }
            }else{
                var_dump($model->errors);
            }
        }
       return $this->render('insert',compact('model'));
    }

    /**修改
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id){
        $model=DeliveryWay::findOne($id);
        $request=\Yii::$app->request;
        if ($request->isPost) {
            $model->load($request->post());
            if ($model->validate()) {
                if ($model->save()) {
                    \Yii::$app->session->setFlash('success','修改成功');
                    return $this->redirect(['index']);
                }
            }else{
                var_dump($model->errors);
            }
        }
        return $this->render('insert',compact('model'));
    }


    /**删除
     * @param $id
     */
    public function actionDelete($id){
        $model=DeliveryWay::findOne($id);
        if ($model->delete()) {
            \Yii::$app->session->setFlash('success','删除成功');
            return $this->redirect(['index']);
        }
    }
}


