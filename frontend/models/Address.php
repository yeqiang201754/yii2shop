<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property int $id
 * @property int $user_id 用户id
 * @property string $user_name 用户名字
 * @property string $province 省
 * @property string $city 市
 * @property string $county 区县
 * @property string $address 具体地址
 * @property string $mobile 手机号
 * @property int $status 状态: 1默认 0非默认
 */
class Address extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_name', 'province', 'city', 'county', 'address'], 'required'],
            [['status'],'safe'],
            [['mobile'],'match','pattern'=>'/(13|14|15|17|18|19)[0-9]{9}/','message' => '请输入正确的手机号'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户id',
            'user_name' => '用户名字',
            'province' => '省',
            'city' => '市',
            'county' => '区县',
            'address' => '具体地址',
            'mobile' => '手机号',
            'status' => '状态: 1默认 0非默认',
        ];
    }
}
