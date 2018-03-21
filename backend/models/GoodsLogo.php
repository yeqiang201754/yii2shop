<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "goods_logo".
 *
 * @property int $id
 * @property string $name 名字
 * @property int $goods_id 商品id
 */
class GoodsLogo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods_logo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'goods_id'], 'required'],
            [['goods_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'goods_id' => '商品id',
        ];
    }
}
