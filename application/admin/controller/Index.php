<?php

namespace app\admin\controller;

use think\Controller;

class Index extends Controller
{
    //重新登录
    public function initialize()
    {
        if (session('?admin.id')){
            $this->redirect('admin/home/index');
        }
    }
    //后台登录
    public function login()
    {
        if (request()->isAjax()){
            $data=[
                'username'=>input('post.username'),
                'password'=>input('post.password')
            ];
            $result=model('Admin')->login($data);
            if ($result==1){
                $this->success('登录成功','admin/home/index');
            }else{
                $this->error($result);
            }
        }
        return view();
    }
    //注册
    public function register()
    {
        if (request()->isAjax()){
            $data=[
                'username'=>input('post.username'),
                'password'=>input('post.password'),
                'conpass'=>input('post.conpass'),
                'nickname'=>input('post.nickname'),
                'email'=>input('post.email'),
            ];
            $result=model('Admin')->register($data);
            if ($result==1){
                $this->success('注册成功','admin/index/login');
            }else{
                $this->error($result);
            }
        }
        return view();
    }
    //重置密码发送验证码
    public function forget()
    {
        if (request()->isAjax()){
            $code=mt_rand(1000,9999);
            session('code',$code);
            $data=[
                'email'=>input('post.email')
            ];
           $result= mailto(input('post.email'),'重置密码验证码','您的重置验证码是'.$code);
           if ($result){
               $this->success('验证码发送成功');
           }else{
               $this->error('验证码发送失败');
           }
        }
        return view();
    }

    public function reset()
    {
        $data=[
            'code'=>input('post.code'),
            'email'=>input('post.email')
        ];
        $result=model('Admin')->reset($data);
        if ($result==1){
            $this->success('密码重置成功，请去邮箱查看密码','admin/index/login');
        }else{
            $this->error($result);
        }
    }
}
