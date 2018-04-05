<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property int $id
 * @property string $name 名字
 * @property string $content 标准
 */
class Payment extends \yii\db\ActiveRecord
{
public static $immediates=['线下支付','线上支付'];
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'content','immediate'], 'required'],
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
            'content' => '标准',
            'immediate'=>'支付方式'
        ];
    }
}
