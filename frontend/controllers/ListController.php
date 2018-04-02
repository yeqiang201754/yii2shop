<?php
/**
 * Created by PhpStorm.
 * User: yeqiang
 * Date: 2018/3/29
 * Time: 14:03
 */

namespace frontend\controllers;


use backend\models\Goods;
use backend\models\GoodsClass;
use Codeception\Module\Yii1;
use frontend\components\ShopCart;
use frontend\models\Cart;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Cookie;

class ListController extends Controller
{


    /**显示所有
     * @param $id
     * @return string
     */
     public function actionIndex($id){

         $goods_calss=GoodsClass::findOne($id);
         $goods_calss_son=GoodsClass::find()->where(['tree'=>$goods_calss->tree])->andWhere(['>=','lift',$goods_calss->lift])->andWhere(['<=','right',$goods_calss->right])->all();
       // var_dump($goods_calss_son);exit;
         $goods_calss_id=array_column($goods_calss_son,'id');
         $goods=Goods::find()->where(['in','goods_class_id',$goods_calss_id])->andWhere(['status'=>1])->all();
       //  var_dump($goods);exit;


return $this->render('index',compact('goods'));
     }

    /**显示商品
     * @param $id
     * @return string
     */
     public function actionContent($id){

         $goods=Goods::findOne($id);



         return $this->render('content',compact('goods'));
     }

    /**添加购物车
     * @param $id商品id
     * @param $num数量
     */

    public function actionAddCart($id ,$amount){

        $carts=new ShopCart();
        if (\Yii::$app->user->isGuest) {
//            //得到Cooke对象
//          $getCookie=\Yii::$app->request->cookies;
//          //得到购物车原来数据
//
//          $cart=$getCookie->getValue('cart',[]);
//        //  var_dump($cart);exit();
//          //判断当前商品购物车中是否已经存在
//            if (array_key_exists($id,$cart)) {
//                $cart[$id]+=$amount;
//            }else{
//                $cart[$id]=$amount;
//            }
//
//            $setCookie=\Yii::$app->response->cookies;
//            //创建cookie对像
//            $cookie=new Cookie([
//                'name'=>'cart',
//                'value' =>$cart
//            ]);
//         //通过cookie对象添加一个cookie
//            $setCookie->add($cookie);
//            \Yii::$app->session->setFlash('success','添加到购物车成功');
//          //  var_dump($setCookie);

            $carts->add($id,$amount)->save();


        }else{
//            //判断是否已经有该商品
//            if ($cart=Cart::findOne(['goods_id'=>$id])) {
//                $n=$cart->num;
//
//            }else{
//                $cart=new Cart();
//                $n=0;
//            }
//            //赋值
//$cart->goods_id=$id;
//$cart->num=$amount+$n;
//$cart->status=1;
//$cart->user_id=\Yii::$app->user->id;
//            if ($cart->validate()) {
//                if ($cart->save()) {
//                  \Yii::$app->session->setFlash('success','添加到购物车成功');
//                }else{
//                    var_dump($cart->errors);
//                }
//            }
      ;
         $carts->dbAdd($id,$amount);


        }
return $this->redirect(['/list/cart-list']);
    }

    /**购物车列表
     * @return string
     */
    public function actionCartList(){

        $carts=new ShopCart();
         //判断是否登陆
        if (\Yii::$app->user->isGuest) {
//            //得到cookie中的cart
//            $cart=\Yii::$app->request->cookies->getValue('cart',[]);

            $cart=$carts->show();
        }else{


            $cart=$carts->dbShow();
        }

        $goods_ids=array_keys($cart);
        $goodss=Goods::find()->where(['in','id',$goods_ids])->all();
       return $this->render('cartlist',compact('goodss', 'cart'));
    }

    /**购物车修改
     * @param $id商品id
     * @param $amuunt数量
     */
    public function actionUptadeCart($id,$amount){

        $cart=new ShopCart();
      //判断是否登陆
        if (\Yii::$app->user->isGuest) {
           //取出cookie中购物车
//          $cart=\Yii::$app->request->cookies->getValue('cart',[]);
//           //修改
//            $cart[$id]=$amount;
//            //创建cookie对象
//            $setCookie=\Yii::$app->response->cookies;
//            $cookie=new Cookie([
//               'name'=>'cart',
//                'value' => $cart
//            ]);
//          $setCookie->add($cookie);

$cart->update($id,$amount)->save();
        }else{
//          $cart=Cart::findOne(['goods_id'=>$id,'user_id'=>\Yii::$app->user->id,'status'=>1]);
//           $cart->num=$amount;
//            if ($cart->save()) {
//                \Yii::$app->session->setFlash('success','修改商品成功');
            //           }

          $cart->dbUpdate($id,$amount);
            //数据库
        }

        return $this->redirect(['/goods/sdsd']);
    }

    /**删除购物车
     * @param $id商品id
     */
    public function actionDeleteCart($id){

        $cart=new ShopCart();
        //判断是否登陆
      if (\Yii::$app->user->isGuest) {
//            //取出cookie中购物车
//            $cart=\Yii::$app->request->cookies->getValue('cart',[]);
//            //修改
//            unset($cart[$id]);
//            //创建cookie对象
//            $setCookie=\Yii::$app->response->cookies;
//            $cookie=new Cookie([
//                'name'=>'cart',
//                'value' => $cart
//            ]);
//            $setCookie->add($cookie);

          $cart->delete($id)->save();

        }else{
//         $cart=Cart::findOne(['goods_id'=>$id,'user_id'=>\Yii::$app->user->id,'status'=>1]);
//            if ($cart->delete()) {
//                \Yii::$app->session->setFlash('success','删除商品成功');
//            }
$cart->dbDelete($id);
        }

        return $this->redirect(['/list/cart-list']);

    }
}