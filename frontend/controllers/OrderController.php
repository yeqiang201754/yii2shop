<?php
/**
 * Created by PhpStorm.
 * User: yeqiang
 * Date: 2018/3/31
 * Time: 14:19
 */

namespace frontend\controllers;


use backend\models\DeliveryWay;
use backend\models\Goods;
use backend\models\Order;
use backend\models\OrderDetails;
use backend\models\Payment;
use frontend\models\Address;
use frontend\models\Cart;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class OrderController extends Controller
{

    public function actionIndex(){

        if (\Yii::$app->user->id==null) {


            return $this->redirect(['user/login','url'=>'/list/cart-list']);
        }else{

            $user_id=\Yii::$app->user->id;
          $addresss=Address::find()->where(['user_id'=>$user_id])->all();
            $delivery_ways=DeliveryWay::find()->all();
            $payment=Payment::find()->all();
            $carts=Cart::find()->where(['user_id'=>$user_id,'status'=>1])->all();
            $cart=ArrayHelper::map($carts,'goods_id','num');
            $goods_ids=array_keys($cart);
            $goodss=Goods::find()->where(['in','id',$goods_ids])->all();

            $request=\Yii::$app->request;
            if ($request->isPost) {
//事务
                $db = \Yii::$app->db;
                $transaction = $db->beginTransaction();

                try {


                    $address_id=$request->post('address_id');
                    // $address=Address::findOne(['id'=>$addresss,'user_id'=>$user_id]);
                    $delivery_ways_id=$request->post('delivery');
                    $total=$request->post('total');
                    $payment_id=$request->post('pay');

                    $order=new Order();
                    $order->user_id=$user_id;
                    $order->delivery_way_id=$delivery_ways_id;
                    $order->address_id=$address_id;
                    $order->payment_id=$payment_id;
                    $order->status=1;
                    $order->sn=time().rand(10000,99999);
                    $order->add_time=time();
                    if ($order->save()) {
                        foreach ($goodss as $goods){
                            $order_details=new OrderDetails();
                            $order_details->goods_id=$goods->id;
                            $order_details->amount=$cart[$goods->id];
                            $order_details->order_id=$order->id;
                            if ($order_details->save()) {
                                if ($goods->num>=$order_details->amount) {
                                    $goods->num-=$order_details->amount;
                                    if ($goods->save(false)) {
                                    }
                                }else{
                                    throw new Exception($goods->title.'库存不足');
                                }
                            }
                        }
                    }

                    //执行事务

                    $transaction->commit();

                    return json_encode([
                       'status'=>1,
                        'msg'=>'执行成功'

                    ]);

                } catch(Exception $e) {

                    $transaction->rollBack();
                    return json_encode([
                        'status'=>0,
                        'msg'=>$e->getMessage()

                    ]);
                }
            }

     return     $this->render('index',compact('goodss','addresss','delivery_ways','payment','cart'));

        }
    }


public function actionInsert(){




}

public function actionOver(){
    return $this->render('over');
}
}