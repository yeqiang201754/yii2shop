<?php

namespace backend\controllers;

use backend\models\Payment;

class PaymentController extends \yii\web\Controller
{
    public function actionIndex()
    {

        $models=Payment::find()->all();
        return $this->render('index',compact('models'));
    }


    public function actionInsert(){
        $model=new Payment();
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



    public function actionUpdate($id){
        $model=Payment::findOne($id);
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


    public function actionDelete($id){
        $model=Payment::findOne($id);
        if ($model->delete()) {
            \Yii::$app->session->setFlash('success','删除成功');
            return $this->redirect(['index']);
        }
    }

}
