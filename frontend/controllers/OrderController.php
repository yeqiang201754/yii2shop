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
use yii\helpers\Url;
use yii\web\Controller;
use EasyWeChat\Foundation\Application;
use Endroid\QrCode\QrCode;
class OrderController extends Controller
{

    public $enableCsrfValidation=false;
    /**确认订单
     * @return string|\yii\web\Response
     */
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

                            Cart::updateAll(['status'=>0],['user_id'=>$user_id,'status'=>1]);



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
                        'msg'=>'执行成功',
                        'order_id'=>$order->id,

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

    /**判断支付方式
     * @param $id订单id
     * @return string
     */

public function actionOk($id){


    $order=Order::findOne($id);
    $payment1=Payment::findOne($order->payment_id);
   // $order_details=OrderDetails::find()->where(['order_id'=>$id]);

    switch ($payment1->id){
        case 1;
            return $this->render('over');
        break;
        case 2;
            return $this->render('over');
        break;
        case 3;
          return $this->render('weixin',compact('order'));
        break;


    }
    //return $this->render('over');
}


    /**二维码生成
     * @param $id订单id
     */
public function actionWx($id){

    $order=Order::findOne($id);
   // $payment1=Payment::findOne($order->payment_id);
    $order_details=OrderDetails::find()->where(['order_id'=>$id])->all();

    $html="";
   foreach ($order_details as $v) {

      $goods=Goods::findOne(['id'=>$v->goods_id]);
    // var_dump($goods);exit;
       $html.=$goods->title;
   }

    $options = \Yii::$app->params['wx'];
    //得到微信对象
    $app = new Application($options);
//得到支付对象
    $payment = $app->payment;
//var_dump($payment);exit;
    $attributes = [
        'trade_type'       => 'NATIVE', // JSAPI，NATIVE，APP...     NATIVE是扫描支付
        'body'             => '吹NB商城',
        'detail'           => $html,
        'out_trade_no'     => $order->sn,
        'total_fee'        => 1, // 单位：分
        'notify_url'       => Url::to('order/notify',true), // 支付结果通知网址，如果不设置则会使用配置里的默认地址
       // 'openid'           => '当前用户的 openid', // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
        // ...
    ];

    $order = new \EasyWeChat\Payment\Order($attributes);
    $result = $payment->prepare($order);

    if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
      //  $prepayId = $result->prepay_id;


        $qrCode = new QrCode($result->code_url);

        header('Content-Type: '.$qrCode->getContentType());
        echo $qrCode->writeString();
    }
}

    /**异步通知
     * @return \Symfony\Component\HttpFoundation\Response
     */

public function actionNotify(){

    $options = \Yii::$app->params['wx'];
    //得到微信对象
    $app = new Application($options);

    $response = $app->payment->handleNotify(function($notify, $successful){
        // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
        //$order = 查询订单($notify->out_trade_no);
      $order = Order::findOne(['sn'=>$notify->out_trade_no]);

        if (!$order) { // 如果订单不存在
            return 'Order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
        }

        // 如果订单存在
        // 检查订单是否已经更新过支付状态
        if ($order->status!=1) { // 假设订单字段“支付时间”不为空代表已经支付
            return true; // 已经支付成功了就不再更新了
        }

        // 用户是否支付成功
        if ($successful) {
            // 不是已经支付状态则修改为已经支付状态
           // $order->paid_at = time(); // 更新支付时间为当前时间
            $order->status = 2;
        }
        // else { // 用户支付失败
         //   $order->status = 'paid_fail';
       // }

        $order->save(); // 保存订单

        return true; // 返回处理完成
    });

    return $response;



}

    /**支付完成跳转
     * @return string
     */
public function actionOver(){
    return  $this->render('over');
}


    /**
     * 如果支付完成就改变状态
     */
public function actionMonitor(){
    $id=\Yii::$app->request->get('id');
    $order=Order::findOne($id);
    $status=$order->status;
if($status==2){
    $result=[
        'status'=>1,
    ];
}else{
    $result=[
        'status'=>0,
    ];
}

   echo  json_encode($result);
}


    /**
     * 删除超时未支付的
     */
public function actionDelete(){
$payment=Payment::find()->where(['immediate'=>1])->all();
$payment=array_column($payment,'id');
$time=time()-900;
$orders=Order::find()->where(['<','add_time',$time])->andWhere(['in','payment_id',$payment])->all();
foreach ($orders as $order){
    $order->status=0;
    $order->save();
}
}



}