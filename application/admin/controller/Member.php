<?php

namespace app\admin\controller;


class Member extends Base
{


    //会员列表
    public function all()
    {
        $member=model('Member')->order('create_time')->paginate(10);
        //定义一个模板数据变量
        $viewData=[
            'members'=>$member,
        ];
        //渲染视图
        $this->assign($viewData);
        return view();
    }

    //会员添加
    public function add()
    {
        if (request()->isAjax()){
            $data=[
                'username'=>input('post.username'),
                'password'=>input('post.password'),
                'nickname'=>input('post.nickname'),
                'email'=>input('post.email'),
            ];
            $result=model('Member')->add($data);
            if ($result==1){
                $this->success('会员添加成功','admin/member/all');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    public function edit()
    {
        if (request()->isAjax()){
            $data=[
                'id'=>input('post.id'),
                'oldpass'=>input('post.oldpass'),
                'newpass'=>input('post.newpass'),
                'nickname'=>input('post.nickname'),
            ];
            $result=model('Member')->edit($data);
            if ($result==1){
                $this->success('会员修改成功','admin/member/all');
            }else{
                $this->error($result);
            }
        }
        $memerInfo=model('Member')->find(input('id'));
        $viewData=[
            'memberInfo'=>$memerInfo
        ];
        $this->assign($viewData);
        return view();
    }
    
    //会员删除
    public function del()
    {
        $memberInfo=model('Member')->with('comments')->find(input('post.id'));
        $result=$memberInfo->together('comments')->delete();
        if ($result){
            $this->success('会员删除成功！','admin/member/all');
        }else{
            $this->error('会员删除失败！');
        }
    }
}
