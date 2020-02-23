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
}
