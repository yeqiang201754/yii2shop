<?php

namespace frontend\controllers;

use frontend\models\Address;
use yii\helpers\Json;

class AddressController extends \yii\web\Controller
{

    /**显示
     * @return string
     */
    public function actionIndex()
    {
         $id=\Yii::$app->user->id;
         $address=Address::find()->where(['user_id'=>$id])->all();
         $count=count($address);


        return $this->render('index',compact('address','count'));
    }

    /**添加
     * @return string
     */


    public function actionInsert(){
        $address=new Address();
        $request=\Yii::$app->request;
        if ($request->isPost) {
            if ($address->load($request->post() ) && $address->validate()) {
              $address->user_id=\Yii::$app->user->id;
           $address->status= $address->status!=null?1:0;
                if ($address->status) {
                       $add=Address::findOne(['status'=>1,'user_id'=>$address->user_id]);
                    if ($add) {
                        $add->status=0;
                       $add->save();
                    }
                    }
                if ($address->save()) {
                    $result = [
                        'status' =>1,
                        'msg' => '添加成功',
                        'data' => null,
                    ];
                    return Json::encode($result);
                }
                }else {
                $result = [
                    'status' =>0,
                    'msg' => '添加失败',
                    'data' => $address->errors
                ];
                return Json::encode($result);

            }
            }
    }

    /**
     * @param $id删除
     * @return \yii\web\Response
     */
    public function actionDelete($id){
        $address=Address::findOne(['id'=>$id]);
        if ($address->delete()) {
            \Yii::$app->session->setFlash('success','删除成功');
            return $this->redirect('/address/index');
        }
    }

    /**设为默认
     * @param $id
     * @return \yii\web\Response
     */
    public function actionStatus($id){
              $address=Address::findOne(["id"=>$id]);
              Address::updateAll(['status'=>0],['user_id'=>\Yii::$app->user->id]);

              $address->status=1;
        if ($address->save()) {
            return $this->redirect(['index']);
        }
    }

    /**取消默认
     * @param $id
     * @return \yii\web\Response
     */

    public function actionStatusOut($id){
        $address=Address::findOne(["id"=>$id]);
        $address->status=0;
        if ($address->save()) {
            return $this->redirect(['index']);
        }
    }
}
