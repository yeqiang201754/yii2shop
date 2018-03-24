<?php
/**
 * Created by PhpStorm.
 * User: yeqiang
 * Date: 2018/3/24
 * Time: 18:07
 */

namespace backend\filters;


use yii\base\ActionFilter;
use yii\web\Controller;
use yii\bootstrap\Html;
class Rbacfilter extends ActionFilter
{
     public function beforeAction($action)
     {
         if(!\Yii::$app->user->can($action->uniqueId)){


$html=<<<html
<h4>你没有权限访问此页！！！</h4>
<input type="button" name="Submit" onclick="javascript:history.back(-1);" value="返回">
html;

     echo $html;

             return false;

         }
         return parent::beforeAction($action);
     }
}