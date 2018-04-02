<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "delivery_way".
 *
 * @property int $id
 * @property string $name 名字
 * @property string $price 价格
 * @property string $standard 标准
 */
class DeliveryWay extends \yii\db\ActiveRecord
{


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price','name', 'standard'], 'required'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名字',
            'price' => '价格',
            'standard' => '标准',
        ];
    }
}
