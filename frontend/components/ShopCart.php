<?php
/**
 * Created by PhpStorm.
 * User: yeqiang
 * Date: 2018/3/31
 * Time: 11:31
 */

namespace frontend\components;


use frontend\models\Cart;
use yii\base\Component;
use yii\helpers\ArrayHelper;
use yii\web\Cookie;

class ShopCart extends  Component
{
    private $cart;

    //构造函数
    public function __construct(array $config = [])
    {

        //得到Cooke对象
        $getCookie = \Yii::$app->request->cookies;
        $cart = $getCookie->getValue('cart', []);
        parent::__construct($config);
        $this->cart = $cart;
    }


    /**添加
     * @param $id商品id
     * @param $num数量
     * @return $this
     */
    public function add($id, $num)
    {

        //判断当前商品购物车中是否已经存在
        if (array_key_exists($id, $this->cart)) {
            $this->cart[$id] += $num;
        } else {
            $this->cart[$id] = $num;
        }

        return $this;
    }

    /**修改
     * @param $id商品id
     * @param $nun商品数量
     * @return $this
     */

    public function update($id, $num)
    {
        $this->cart[$id] = $num;

        return $this;
    }

    /**显示
     * @return mixed
     */
    public function show()
    {

        return $this->cart;

    }


    /**删除
     * @param $id商品id
     * @return $this
     */

    public function delete($id)
    {
        unset($this->cart[$id]);
        return $this;
    }

    /**清空cookie
     * @return $this
     */
   public function flush(){
       $this->cart=[];
       return $this;
   }
    /**保存
     * @return $this
     */
    public function save()
    {

        $setCookie = \Yii::$app->response->cookies;
        //创建cookie对像

        $cookie = new Cookie([
            'name' => 'cart',
            'value' => $this->cart,
            'expire' => time() + 3600 * 24 * 30 * 12
        ]);
        //通过cookie对象添加一个cookie
        $setCookie->add($cookie);
        \Yii::$app->session->setFlash('success', '添加到购物车成功');
        //  var_dump($setCookie);
        return $this;
    }



    /**添加到数据库
     * @param $id商品id
     * @param $num商品数量
     */
    public function dbAdd($id, $num)
    {

        if ($cartDb = Cart::findOne(['goods_id' => $id])) {
            $n = $cartDb->num;

        } else {
            $cartDb = new Cart();
            $n = 0;
        }
        //赋值
        $cartDb->goods_id = $id;
        $cartDb->num = $num + $n;
        $cartDb->status = 1;
        $cartDb->user_id = \Yii::$app->user->id;
        if ($cartDb->validate()) {
            if ($cartDb->save()) {
                \Yii::$app->session->setFlash('success', '添加到购物车成功');
            } else {
                var_dump($cartDb->errors);
            }
        }
     return $this;
    }


    /**数据库商品显示
     * @return array
     */
public function dbShow(){
    $carts=Cart::find()->where(['user_id'=>\Yii::$app->user->id])->andWhere(['status'=>1])->all();

    $cart=ArrayHelper::map($carts,'goods_id','num');
    return   $cart;
}


    /**修改数据库商品
     * @param $id商品id
     * @param $num商品数量
     * @return $this|bool
     */
public function dbUpdate($id,$num){


    $cart=Cart::findOne(['goods_id'=>$id,'user_id'=>\Yii::$app->user->id,'status'=>1]);
    $cart->num=$num;
    if ($cart->save()) {
        \Yii::$app->session->setFlash('success','修改商品成功');
        return $this;
    }else{
        return false;
    }
}

    /**删除数据库商品
     * @param $ids商品id
     * @return $this|bool
     */
public function dbDelete($id){
    $cart=Cart::findOne(['goods_id'=>$id,'user_id'=>\Yii::$app->user->id,'status'=>1]);
    if ($cart->delete()) {
        \Yii::$app->session->setFlash('success','删除商品成功');
        return  $this;
    }else{
        return false;
    }


}



}