<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title 标题
 * @property string $intro 简介
 * @property int $order 排序
 * @property int $status 状态
 * @property int $class_id 分类id
 * @property int $add_time 添加时间
 * @property int $update_time 更新时间
 */
class Article extends \yii\db\ActiveRecord
{


    public static $statuss=['禁用','激活'];

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

            ],
        ];
    }




    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'intro', 'class_id'], 'required'],
            [['order', 'status'], 'integer'],

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
            'order' => '排序',
            'status' => '状态',
            'class_id' => '分类id',
            'add_time' => '添加时间',
            'update_time' => '更新时间',
        ];
    }


    public function getClass(){
        return $this->hasOne(ArticleClass::className(),['id'=>'class_id']);
    }
}
