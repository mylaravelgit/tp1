<?php

namespace app\admin\controller;

use think\Controller;

class Admin extends Base
{
    //
    public function all()
    {
        $adminInfo=model('Admin')
//            ->order(['is_super'=>'desc','status'=>'desc'])
            ->paginate(10);
        $viewData=[
            'admins'=>$adminInfo,
        ];
        $this->assign($viewData);
        return view();
    }

    public function add()
    {
        if (request()->isAjax()){
            $data=[
                'username'=>input('post.username'),
                'password'=>input('post.password'),
                'conpass'=>input('post.conpass'),
                'nickname'=>input('post.nickname'),
                'email'=>input('post.email'),
            ];
            $result=model('Admin')->add($data);
            if ($result==1){
                $this->success('管理员添加成功','admin/admin/all');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    public function status()
    {
        $data=[
            'id'=>input('post.id'),
            'status'=>input('post.status')?0:1,
        ];
        $adminInfo=model('Admin')->find($data['id']);
        $adminInfo->status=$data['status'];
        $result=$adminInfo->save();
        if ($result){
            $this->success('操作成功','admin/admin/all');
        }else{
            $this->error('操作失败');
        }
    }
}
