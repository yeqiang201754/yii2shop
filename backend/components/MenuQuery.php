<?php
/**
 * Created by PhpStorm.
 * User: yeqiang
 * Date: 2018/3/18
 * Time: 12:36
 */

namespace backend\components;


use creocoder\nestedsets\NestedSetsQueryBehavior;

class MenuQuery extends \yii\db\ActiveQuery
{
    public function behaviors() {
        return [
            NestedSetsQueryBehavior::className(),
        ];
    }
}