<?php

namespace app\admin\controller;

use think\Controller;

class Comment extends Controller
{
    //
    public function all()
    {
        $comment=model('Comment')
            ->with('article,member')
            ->order('create_time')->paginate(10);
        //定义一个模板数据变量
//        dump($comment);
        $viewData=[
            'comments'=>$comment,
        ];
        //渲染视图
        $this->assign($viewData);
        return view();
    }

    public function del()
    {
        $commentInfo=model('Comment')->find(input('post.id'));
        $result=$commentInfo->delete();
        if ($result){
            $this->success('删除成功','admin/comment/all');
        }else{
            $this->error('删除失败');
        }
    }
}
