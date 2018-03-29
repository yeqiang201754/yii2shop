<?php
/**
 * Created by PhpStorm.
 * User: yeqiang
 * Date: 2018/3/27
 * Time: 13:34
 */

namespace frontend\models;


use yii\base\Model;

class UserForm extends Model
{
    public $username;
    public $password;
    public $rememberMe;
    public $checkcode;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['rememberMe'],'safe'],
            [['checkcode'],'captcha','captchaAction'=>'/user/code'] ,

        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'userpassword' => '密码',
            'rememberMe'=>''
        ];
    }

}