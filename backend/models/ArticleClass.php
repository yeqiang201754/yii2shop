<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "article_class".
 *
 * @property int $id
 * @property string $name 名字
 * @property string $intro 简介
 * @property int $order 排序
 * @property int $status 状态
 * @property int $is_help 是否帮助类
 */
class ArticleClass extends \yii\db\ActiveRecord
{
    public static $statuss=['禁用','激活'];
    public static $is_helps=['否','是'];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'intro'], 'required'],
            [['order', 'status', 'is_help'], 'integer'],

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
            'intro' => '简介',
            'order' => '排序',
            'status' => '状态',
            'is_help' => '是否帮助类',
        ];
    }
}
