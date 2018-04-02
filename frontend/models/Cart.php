<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "cart".
 *
 * @property int $id
 * @property int $goods_id 商品id
 * @property int $num 数量
 * @property int $add_time 添加时间
 */
class Cart extends \yii\db\ActiveRecord
{

    //注入行为
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['add_time', 'update_time'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['update_time'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                // 'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'goods_id', 'num','user_id'], 'required'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goods_id' => '商品id',
            'num' => '数量',
            'add_time' => '添加时间',
        ];
    }
}
