<?php

namespace frontend\controllers;

use backend\models\AdminForm;
use frontend\components\ShopCart;
use frontend\models\User;
use frontend\models\UserForm;
use Mrgoon\AliSms\AliSms;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Json;

class UserController extends \yii\web\Controller
{
    /**验证码
     * @return array
     */
    public function actions()
    {
        return [

            'code' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
               'minLength' => 3,
                'maxLength' => 3,
                'foreColor' => 0xFF0000

            ],
        ];
    }




//主页

    public function actionIndex()
    {
        return $this->render('index');
    }

    /**注册
     * @return string
     */

    public function actionReg(){
$request=\Yii::$app->request;
        if ($request->isPost) {
            $user=new User();
          $user->load($request->post());
            if ($user->validate()) {
                $user->password_hash=\Yii::$app->security->generatePasswordHash($user->password_hash);
                $user->auth_key=uniqid();
                if ($user->save(false)) {
                         $result=[
                             'status'=>1,
                             'msg'=>'注册成功',
                             'data'=>'user'
                         ];
                         return  Json::encode($result);
                }
            }else{
                $result=[
                    'status'=>0,
                    'msg'=>'注册失败',
                    'data'=>$user->errors
                ];
                return  Json::encode($result);
            }
        }
        return $this->render('reg');
    }

    /**给手机发验证码
     * @param $mobile手机号
     * @return string
     */


    public function actionSendSms($mobile){
    if ($mobile!=""){

        $code=rand(1000,9999);
          //发送短信
        $config = [
            'access_key' => 'LTAINT9CwvvVLqJ2',
            'access_secret' => '5KM4P1uti7F4RXmuoIi1sOC8jacWMV',
            'sign_name' => '徐平平',
        ];

        $aliSms=new AliSms();
        $response = $aliSms->sendSms($mobile, 'SMS_128840492', ['code'=> $code], $config);
        if ($response->Message=="OK") {
            $session=\Yii::$app->session;
            $session->set($mobile,$code);

            $result=[
                'status'=>1,
                'msg'=>'注册成功',
                'data'=>$code
            ];
            return  Json::encode($result);
        }else{
            var_dump($response->Message);
        }

    }else{
        $result=[
            'status'=>0,
            'msg'=>'获取失败',
            'data'=>["手机号不能为空"]
        ];
        return  Json::encode($result);

    }
    }

    /**短信验证
     * @param $captcha
     * @param $mobile
     * @return string
     */

  public function actionCheckSms($captcha,$mobile){
   $captchaOld=\Yii::$app->session->get($mobile);
      if ($captcha==$captchaOld) {
          $result=[
              'status'=>1,
          ];
          return  Json::encode($result);
      }else{
          $result=[
              'status'=>0,
          ];
          return  Json::encode($result);
      }
  }


    /**登陆
     * @return string
     */
  public function actionLogin(){
      $model=new UserForm();
      $request=\Yii::$app->request;
      if ($request->isPost) {
          $model->load($request->post());
          if ($model->validate()) {
              $admin = User::find()->where(['username' => $model->username, 'status' => 1])->one();
              if ($admin) {
                  if (\Yii::$app->security->validatePassword($model->password, $admin->password_hash)) {
                      \Yii::$app->user->login($admin, $model->rememberMe == "on" ? 3600 * 24 : 0);

                      //同步
                      $carts = new ShopCart();
                      $cart = $carts->show();
                      foreach ($cart as $id => $num) {
                         $carts->dbAdd($id, $num)->flush()->save();
                      }


                      $admin->last_time = time();
                      $admin->last_ip = ip2long(\Yii::$app->request->userIP);
                      if ($admin->save(false)) {
                          //同步
                          $cart = new ShopCart();
                          $result = [
                              'status' => 1,
                              'msg' => '登陆成功',
                              'data' => 'user'
                          ];
                          return Json::encode($result);
                      }
//                  \Yii::$app->session->setFlash('success', '登陆成功');
//                  return $this->redirect(['index']);

                  } else {
                      $result = [
                          'status' => 0,
                          'msg' => '登陆失败',
                          'data' => ['password' => ['密码错误']]
                      ];
                      return Json::encode($result);

                      //  $model->addError('password', '密码错误');
                  }
              } else {
                  $result = [
                      'status' => 0,
                      'msg' => '登陆失败',
                      'data' => ['username' => ['用户名不正确']]
                  ];
                  return Json::encode($result);

                  // $model->addError('username', '用户名不正确');
              }
          } else {
              $result = [
                  'status' => 0,
                  'msg' => '登陆失败',
                  'data' => $model->errors
              ];
              return Json::encode($result);
          }
      }
      return $this->render('login');
  }


  public function actionLogout(){
      \Yii::$app->user->logout();
      return $this->redirect('/user/login');

  }
}
