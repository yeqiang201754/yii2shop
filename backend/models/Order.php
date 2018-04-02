<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $sn 订单编号
 * @property int $user_id 用户id
 * @property int $delivery_way_id 送货方式id
 * @property int $address_id 送货地址id
 * @property int $payment_id 支付方式id
 * @property int $status 状态：0取消1待付款2代发货3待收货4完成
 * @property string $payment_sn 第三方支付编号
 * @property int $add_time 添加时间
 */
class Order extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sn' => '订单编号',
            'user_id' => '用户id',
            'delivery_way_id' => '送货方式id',
            'address_id' => '送货地址id',
            'payment_id' => '支付方式id',
            'status' => '状态：0取消1待付款2代发货3待收货4完成',
            'payment_sn' => '第三方支付编号',
            'add_time' => '添加时间',
        ];
    }
}
