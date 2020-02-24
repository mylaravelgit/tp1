<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Member extends Model
{
    //
    use  SoftDelete;


    //只读字段
    protected $readonly=['username','email'];

    //关联评论
    public function comments()
    {
        return $this->hasMany('Comment','member_id','id');
    }

    //会员添加
    public function add($data)
    {
        $validate=new \app\common\validate\Member();
        if (!$validate->scene('add')->check($data)){
            return $validate->getError();
        }
        $result=$this->allowField(true)->save($data);
        if ($result){
            return 1;

        }else{
            return ' 会员添加失败';
        }

        return false ;
    }

    //会员编辑
    public function edit($data)
    {
        $validate=new \app\common\validate\Member();
        if (!$validate->scene('edit')->check($data)){
            return $validate->getError();
        }
        $memberInfo=$this->find($data['id']);
        if ($data['oldpass']!=$memberInfo['password']){
            return '原密码不正确';
        }
        $memberInfo->password=$data['newpass'];
        $memberInfo->nickname=$data['nickname'];

        $result=$memberInfo->save();
        if ($result){
            return 1;
        }else{
            return ' 会员编辑失败';
        }

        return false ;
    }
}
