<?php

namespace backend\controllers;

use backend\models\AuthItem;

class PermissionController extends \yii\web\Controller
{
    /**显示
     * @return string
     */
    public function actionIndex()
    {
        $auth=\Yii::$app->authManager;
       $pers= $auth->getPermissions();
        return $this->render('index',compact('pers'));
    }


    /**添加
     * @return string|\yii\web\Response
     */
   public function actionInsert(){

          $model=new AuthItem();

       if ($model->load(\Yii::$app->request->post()) && $model->validate()) {


        //创建对象
        $auth=\Yii::$app->authManager;
            //创建权限
       $per=$auth->createPermission($model->name);
         //创建权限描述
      $per->description=$model->description;
       //权限入库
           if ($auth->add($per)) {
               \Yii::$app->session->setFlash('success','添加成功');
             return  $this->refresh();
           }



   }


   return $this->render('insert',compact('model'));
   }

    /**修改
     * @param $name
     * @return string|\yii\web\Response
     */

    public function actionUpdate($name){

        $model=AuthItem::findOne($name);

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {


            //创建对象
            $auth=\Yii::$app->authManager;
            //得到权限
            $per=$auth->getPermission($model->name);
            //创建权限描述
            $per->description=$model->description;
            //权限入库
            if ($auth->update($model->name,$per)) {
                \Yii::$app->session->setFlash('success','修改成功');
                return  $this->redirect(['index']);
            }
        }
        return $this->render('insert',compact('model'));
    }

    /**删除
     * @param $name
     * @return \yii\web\Response
     */
    public function actionDelete($name){

        $auth=\Yii::$app->authManager;
        $pre=$auth->getPermission($name);


        if ($auth->remove($pre)) {
            \Yii::$app->session->setFlash('success','删除成功');
            return $this->redirect(['index']);

        }

    }
}
