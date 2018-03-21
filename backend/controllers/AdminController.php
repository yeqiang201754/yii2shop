<?php

namespace backend\controllers;

use backend\models\Admin;

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

                     $model=new Admin();
                     $request=\Yii::$app->request;
        if ($request->isPost) {
            $model->load($request->post());
            $admin=Admin::find()->where(['username'=>$model->username])->one();

            if ($admin) {

            if (\Yii::$app->security->validatePassword($model->userpassword,$admin->userpassword)) {
                \Yii::$app->user->login($admin);
                \Yii::$app->session->setFlash('success','登陆成功');
                return $this->redirect(['index']);
            }else{
               // \Yii::$app->session->setFlash('danger','密码错误');
               $model->addError('userpassword','密码错误');
            }
            }else{
               // \Yii::$app->session->setFlash('danger','用户名错误');
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
     $request=\Yii::$app->request;
        if ($request->isPost) {
            $model->load($request->post());
            $model->userpassword=\Yii::$app->security->generatePasswordHash($model->userpassword);
            if ($model->validate()) {
                if ($model->save()) {
                    \Yii::$app->session->setFlash('success','添加成功');
                    return $this->redirect(['index']);

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
        $request=\Yii::$app->request;
        if ($request->isPost) {
            $model->load($request->post());
            $model->userpassword=\Yii::$app->security->generatePasswordHash($model->userpassword);
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
     * @return \yii\web\Response
     */

    public function  actionDelete($id){
        $model=Admin::findOne($id);
        if ($model->delete()) {
            \Yii::$app->session->setFlash("success",'删除成功');
            return $this->redirect(['index']);
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
