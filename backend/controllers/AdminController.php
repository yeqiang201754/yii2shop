<?php

namespace backend\controllers;

use backend\models\Admin;
use backend\models\AdminForm;
use backend\models\AuthItem;
use yii\helpers\ArrayHelper;

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



            $user = Admin::find()->where(['username' => $model->username, 'status' => 1])->one();

            if ($user) {

                if (\Yii::$app->security->validatePassword($model->password, $user->password_hash)) {
                    \Yii::$app->user->login($user, $model->rememberMe ? 3600 * 24 : 0);
                    $user->login_at = time();
                    $user->login_ip = ip2long(\Yii::$app->request->userIP);
                   $user->save();
                    \Yii::$app->session->setFlash('success', '登陆成功');
                    return $this->redirect(['index']);

                } else {

                    $model->addError('password', '密码错误');
                }
            } else {

                $model->addError('username', '用户名不正确');
            }


        }
        return $this->render('login',compact('model'));
    }

    /**注销
     * @return \yii\web\Response
     */

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

        $auth=\Yii::$app->authManager;
        $roless=$auth->getRoles();
     $roless=ArrayHelper::map($roless,'name','name');

     $request=\Yii::$app->request;
        if ($request->isPost) {

            $model->load($request->post());
            //var_dump($model);exit;
            $model->password_hash=\Yii::$app->security->generatePasswordHash($model->password_hash);
            if ($model->validate()) {

                $model->auth_key=uniqid();
                if ($model->save()) {

                    if ($model->roles) {


                foreach ($model->roles as $role){

                    //通过角色名找到角色对象
                    $role=$auth->getRole($role);
                    //给用户添加角色
                    $auth->assign($role,$model->id);
                }
                    }
                    \Yii::$app->session->setFlash('success','添加成功');

                    return $this->redirect(['show']);

                }
            }else{
                var_dump($model->errors);
            }

        }

     return $this->render('insert',compact('model','roless'));

    }

    /**修改
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id){

        $model=Admin::findOne($id);
        $model->setScenario('update');
       $password= $model->password_hash;
        $auth=\Yii::$app->authManager;
        $roless=$auth->getRoles();
        $roless=ArrayHelper::map($roless,'name','name');


        $role=$auth->getRolesByUser($id);
        $role=array_keys($role);

        $model->roles=$role;



        $request=\Yii::$app->request;
        if ($request->isPost) {

             $model->load($request->post());

            $model->password_hash = $model->password_hash=="" ? $password : \Yii::$app->security->generatePasswordHash($model->password_hash);

            if ($model->validate()) {

                $model->auth_key=uniqid();

                if ($model->save()) {

                    if ($model->roles) {
                        //删除以前的
                        $auth->revokeAll($id);

                        foreach ($model->roles as $role){
                            //实例化
                            $auth=\Yii::$app->authManager;

                            //通过角色名找到角色对象
                            $role=$auth->getRole($role);
                            //给用户添加角色
                            $auth->assign($role,$model->id);
                        }
                    }
                    \Yii::$app->session->setFlash('success','修改成功');

                    return $this->redirect(['show']);

                }
            }else{
                var_dump($model->errors);
            }

        }

        return $this->render('insert',compact('model','roless'));

    }

    /**删除
     * @param $id
     * @return \yii\web\Response
     */

    public function  actionDelete($id){
        $model=Admin::findOne($id);
        $auth=\Yii::$app->authManager;
        if ($model->status==0 &&$auth->revokeAll($id)) {
            if ($model->delete() ) {
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
