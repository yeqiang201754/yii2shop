<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property int $id
 * @property string $name 名称
 * @property string $intro 简介
 * @property string $logo 图片
 * @property int $status 状态
 * @property int $sort 排序
 */
class Brand extends \yii\db\ActiveRecord
{
    public static $statuss=['隐藏','显示'];
    public $img;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'intro', 'status'], 'required'],
            [['sort'],'safe'],
            [['img'], 'image', 'extensions' => ['gif', 'jpg', 'png'], "skipOnEmpty" => true],



        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'intro' => '简介',
            'logo' => '图片',
            'status' => '状态',
            'sort' => '排序',
            'img'=>'图片'
        ];
    }
}
