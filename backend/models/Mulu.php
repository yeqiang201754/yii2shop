<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mulu".
 *
 * @property int $id
 * @property string $name 名称
 * @property string $ico 图标
 * @property string $url 地址
 * @property int $p_id 上级id
 */
class Mulu extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'url', 'p_id'], 'required'],
            [['p_id'], 'integer'],
            [['ico'],'safe']

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
            'ico' => '图标',
            'url' => '地址',
            'p_id' => '上级id',
        ];
    }


    public static function mulu(){

//$mulu=      [
//    ['label' => '管理列表', 'options' => ['class' => 'header']],
//
//                    [
//                        'label' => '商品分类管理',
//                        'icon' => 'shopping-cart',
//                        'url' => '#',
//                        'items' => [
//                            ['label' => '商品分类列表', 'icon' => 'dashboard', 'url' => ['/goods-class/index'],],
//                            ['label' => '商品分类添加', 'icon' => 'file-code-o', 'url' => ['/goods-class/insert'],],
//
//                        ],
//                    ],
//];
//
        $mulu=[];
        $mulu0s=Mulu::find()->where(['p_id'=>0])->all();

        foreach ($mulu0s as $mu0){
            $mulu0=[];
            $mulu0['label']=$mu0->name;
            $mulu0['icon']=$mu0->ico;
            $mulu0['url']=$mu0->url;
            $mulu1s=Mulu::find()->where(['p_id'=>$mu0->id])->all();
            foreach ($mulu1s as $mu1) {
                $mulu1 = [];
                $mulu1['label'] = $mu1->name;
                $mulu1['icon'] = $mu1->ico;
                $mulu1['url'] = [$mu1->url];
                $mulu0['items'][]= $mulu1;
            }
            $mulu[]=$mulu0;
        }
return $mulu;

    }
}
