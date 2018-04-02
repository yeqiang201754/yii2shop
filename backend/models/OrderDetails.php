<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "order_details".
 *
 * @property int $id
 * @property int $goods_id 商品id
 * @property int $amount 数量
 * @property int $payment_id 订单编号
 */
class OrderDetails extends \yii\db\ActiveRecord
{


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goods_id' => '商品id',
            'amount' => '数量',
            'payment_id' => '订单编号',
        ];
    }
}
