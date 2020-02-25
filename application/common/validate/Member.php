<?php


namespace app\common\validate;


use think\Validate;

class Member extends Validate
{

    protected $rule=[
        'username|用户名'=>'require|unique:member',
        'password|密码'=>'require',
        'conpass|确认密码'=>'require|confirm:password',
        'oldpass|原密码'=>'require',
        'newpass|新密码'=>'require',
        'nickname|昵称'=>'require',
        'email|邮箱'=>'require|email|unique:member',
        'verify|验证码'=>'require|captcha',

    ];
    public function sceneAdd()
    {
        return $this->only(['username','password','nickname','email']);
    }

    public function sceneEdit()
    {
        return $this->only(['nickname','oldpass','newpass',]);
    }

    public function sceneRegister()
    {
        return $this->only(['username','password','nickname','email','conpass','verify']);
    }
    public function sceneLogin()
    {
        return $this->only(['username','password','verify'])
            ->remove('username','unique');
    }
}