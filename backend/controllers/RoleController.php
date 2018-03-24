<?php

namespace backend\controllers;

use backend\models\AuthItem;
use yii\helpers\ArrayHelper;

class RoleController extends \yii\web\Controller
{
    /**显示
     * @return string
     */
    public function actionIndex()
    {
        $auth=\Yii::$app->authManager;
       $roles= $auth->getRoles();
        return $this->render('index',compact('roles'));
    }


    /**添加
     * @return string|\yii\web\Response
     */
   public function actionInsert(){

          $model=new AuthItem();
           $auth=\Yii::$app->authManager;
          $pers=$auth->getPermissions();
          $pers=ArrayHelper::map($pers,'name','description');

       if ($model->load(\Yii::$app->request->post()) && $model->validate()) {


        //创建对象
        $auth=\Yii::$app->authManager;
            //创建角色
       $role=$auth->createRole($model->name);
         //创建角色描述
      $role->description=$model->description;
       //角色入库
           if ($auth->add($role)) {

               //判断角色有没有权限
               if($model->permissions){
                   //循环角色权限
               foreach ($model->permissions as $per){
                   $per=$auth->getPermission($per);
                   $auth->addChild($role,$per);
               }
           }
               \Yii::$app->session->setFlash('success','添加成功');
             return  $this->refresh();
           }
   }


   return $this->render('insert',compact('model','pers'));
   }

    /**修改
     * @param $name
     * @return string|\yii\web\Response
     */

    public function actionUpdate($name){

        $model=AuthItem::findOne($name);
        $auth=\Yii::$app->authManager;
        $pers=$auth->getPermissions();
        $pers=ArrayHelper::map($pers,'name','description');
        $model->permissions=$auth->getPermissionsByRole($name);
        //取数组中的所有key值组成新的数组
        $model->permissions=array_keys($model->permissions);

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {


            //创建对象
            $auth=\Yii::$app->authManager;
            //创建角色
            $role=$auth->getRole($model->name);
            //创建角色描述
            $role->description=$model->description;
            //角色入库
            if ($auth->update($model->name,$role)) {
               //删除之前的所有权限
                $auth->removeChildren($role);
                //判断角色有没有权限
                if($model->permissions){
                    //循环角色权限
                    foreach ($model->permissions as $per){
                        $per=$auth->getPermission($per);
                        $auth->addChild($role,$per);
                    }
                }
                \Yii::$app->session->setFlash('success','修改成功');
                return  $this->redirect(['index']);
            }
        }
        return $this->render('insert',compact('model','pers'));
    }

    /**删除
     * @param $name
     * @return \yii\web\Response
     */
    public function actionDelete($name){

        $auth=\Yii::$app->authManager;
        $role=$auth->getRole($name);


        if ($auth->remove($role)) {
            \Yii::$app->session->setFlash('success','删除成功');
            return $this->redirect(['index']);

        }

    }
}
