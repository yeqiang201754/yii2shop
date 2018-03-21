<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "goods_content".
 *
 * @property int $id
 * @property string $content 内容
 * @property int $goods_id 商品id
 */
class GoodsContent extends \yii\db\ActiveRecord
{
    public $img;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods_content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'goods_id'], 'required'],
            [['goods_id'], 'integer'],
            [['img'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => '内容',
            'goods_id' => '商品id',
            'img'=>'图片'
        ];
    }
}
