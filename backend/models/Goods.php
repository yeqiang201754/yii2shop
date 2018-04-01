<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "goods".
 *
 * @property int $id
 * @property string $title 标题
 * @property string $intro 简介
 * @property string $logo 图片
 * @property int $market_price 市场价
 * @property int $goods_price 商场价
 * @property int $sn 编号
 * @property int $goods_class_id 商品分类id
 * @property int $brand_id 品牌id
 * @property int $num 库存
 * @property int $roder 排序
 * @property int $status 是否上架
 * @property int $add_time 添加时间
 */
class Goods extends \yii\db\ActiveRecord
{
public static $statuss=['下架','上架'];

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [

                    ActiveRecord::EVENT_BEFORE_INSERT => ['add_time', 'update_time'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['update_time'],
                ],
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'intro', 'market_price', 'goods_price', 'goods_class_id', 'brand_id', 'num',], 'required'],
            [['market_price', 'goods_price', 'goods_class_id', 'brand_id', 'num', 'roder', 'status', 'add_time'], 'integer'],
          [['sn','logo'],'safe'],
            [['sn'],'unique'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'intro' => '简介',
            'logo' => '图片',
            'market_price' => '市场价',
            'goods_price' => '商场价',
            'sn' => '编号',
            'goods_class_id' => '商品分类id',
            'brand_id' => '品牌id',
            'num' => '库存',
            'roder' => '排序',
            'status' => '是否上架',
            'add_time' => '添加时间',
        ];
    }
    public function getBrand(){
        return $this->hasOne(Brand::className(),['id'=>'brand_id']);
    }
    public function getGoodsClass(){
        return $this->hasOne(GoodsClass::className(),['id'=>'goods_class_id']);
    }

    public function getImgs(){

        return $this->hasMany(GoodsLogo::className(),['goods_id'=>'id']);

    }

    public function getContent(){

        return $this->hasOne(GoodsContent::className(),['goods_id'=>'id']);
    }
}
