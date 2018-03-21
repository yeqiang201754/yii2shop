<?php

namespace backend\models;

use backend\components\MenuQuery;
use creocoder\nestedsets\NestedSetsBehavior;
use Yii;

/**
 * This is the model class for table "goods_class".
 *
 * @property int $id
 * @property int $tree
 * @property int $lift 左
 * @property int $right 右
 * @property int $deep 深度
 * @property string $name 名字
 * @property string $intor 简介
 * @property string $p_id 父级id
 */
class GoodsClass extends \yii\db\ActiveRecord
{

 //注入
    public function behaviors() {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                'treeAttribute' => 'tree',
                 'leftAttribute' => 'lift',
                'rightAttribute' => 'right',
               'depthAttribute' => 'deep',
            ],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {
        return new MenuQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'name'], 'required'],
            [[ 'intor', 'p_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tree' => 'Tree',
            'lift' => '左',
            'right' => '右',
            'deep' => '深度',
            'name' => '名字',
            'intor' => '简介',
            'p_id' => '父级id',
        ];
    }

    public function getNameText(){


        return str_repeat("&emsp;",$this->deep*2).$this->name;
    }
}
