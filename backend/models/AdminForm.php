<?php


namespace backend\models;


use yii\base\Model;

class AdminForm extends Model
{
   public $username;
   public $password;
   public $rememberMe=true;
   public function rules()
   {
       return [
           [['username', 'password'], 'required'],
           [ ['username'],'unique'],
           [['rememberMe'],'safe']
       ];
   }

   public function attributeLabels()
   {
       return [
           'id' => 'ID',
           'username' => '用户名',
           'userpassword' => '密码',
           'rememberMe'=>'是否记住密码'
       ];
   }

}