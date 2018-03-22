<?php

namespace backend\controllers;

use backend\models\Admin;
use backend\models\AdminForm;

class AdminController extends \yii\web\Controller
{
    /**后台主页
     * @return string
     */

    public function actionIndex()
    {
        return $this->render('index');
    }


    /**登陆
     * @return string|\yii\web\Response
     */
    public function actionLogin(){

                     $model=new AdminForm();
                     $request=\Yii::$app->request;
        if ($request->isPost) {
            $model->load($request->post());

            $admin=Admin::find()->where(['username'=>$model->username,'status'=>1])->one();

            if ($admin) {

            if (\Yii::$app->security->validatePassword($model->password,$admin->password_hash)) {
                \Yii::$app->user->login($admin,$model->rememberMe?3600*24:0);
                $admin->login_at=time();
                $admin->login_ip=ip2long(\Yii::$app->request->userIP);
                if ($admin->save()) {
                    \Yii::$app->session->setFlash('success','登陆成功');
                    return $this->redirect(['index']);
                }

            }else{

               $model->addError('password','密码错误');
            }
            }else{

             $model->addError('username','用户名不正确');
            }

        }
        return $this->render('login',compact('model'));
    }



    public function actionLogout(){

\Yii::$app->user->logout();
return $this->redirect(['login']);


    }

    /**
     * 添加
     */
    public function actionInsert(){

     $model=new Admin();
        $model->setScenario('insert');
     $request=\Yii::$app->request;
        if ($request->isPost) {
            $model->load($request->post());
            $model->password_hash=\Yii::$app->security->generatePasswordHash($model->password_hash);
            if ($model->validate()) {

                $model->auth_key=uniqid();
                if ($model->save()) {
                    \Yii::$app->session->setFlash('success','添加成功');

                    return $this->redirect(['show']);

                }
            }else{
                var_dump($model->errors);
            }

        }

     return $this->render('insert',compact('model'));

    }

    /**修改
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id){

        $model=Admin::findOne($id);
       $password= $model->password_hash;
       $model->setScenario('update');
        $request=\Yii::$app->request;
        if ($request->isPost) {
             $model->load($request->post());

            $model->password_hash = $model->password_hash=="" ? $password : \Yii::$app->security->generatePasswordHash($model->password_hash);

            if ($model->validate()) {

                $model->auth_key=uniqid();
                if ($model->save()) {
                    \Yii::$app->session->setFlash('success','修改成功');

                    return $this->redirect(['show']);

                }
            }else{
                var_dump($model->errors);
            }

        }

        return $this->render('insert',compact('model'));

    }

    /**删除
     * @param $id
     * @return \yii\web\Response
     */

    public function  actionDelete($id){
        $model=Admin::findOne($id);
        if ($model->status==0) {
            if ($model->delete()) {
                \Yii::$app->session->setFlash("success",'删除成功');
                return $this->redirect(['show']);
            }
        }else{
            \Yii::$app->session->setFlash("danger",'只能删除状态为禁用的管理员数据');
            return $this->redirect(['show']);
        }

    }

    /**显示
     * @return string
     */

    public function actionShow(){
      $admins=Admin::find()->all();
      return $this->render('show',compact('admins'));





    }
}
