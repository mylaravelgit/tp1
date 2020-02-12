<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Admin extends Model
{
    //软删除
    use SoftDelete;

    //登录校检
    public function login($data)
    {
        $validate=new \app\common\validate\Admin();
        if (!$validate->scene('login')->check($data)){
            return $validate->getError();
        }
        $result=$this->where($data)->find();
//        $result = $this->where($data)->find();
        if ($result){
            //判断用户是否可用
            if ($result['status']!=1){
                return '此账户被禁用！';
            }
            $sessionData=[
                'id'=>$result['id'],
                'nickname'=>$result['nickname'],
                'is_super'=>$result['is_super']
            ];
            session('admin',$sessionData);
            //1表示有这个用户，也就是用户名和密码正确
            return 1;
        }else{
            return '用户名或者密码错误';
        }
    }

    public function register($data)
    {
        $validate= new \app\common\validate\Admin();
        if (!$validate->scene('register')->check($data)){
            return $validate->getError();
        }
        //allowField(true) 数据库有的字段才会添加
        $result=$this->allowField(true)->save($data);
        if ($result){
            mailto($data['email'],'注册管理员账户成功','注册管理员账户成功！');
            return 1;
        }else{
            return '注册失败';
        }

    }
}
