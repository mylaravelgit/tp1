<?php

namespace app\admin\controller;

use think\Controller;

class Cate extends Base
{
    //栏目列表
    public function list()
    {
        $cates=model('Cate')->order('sort','asc')->paginate(10);
        //定义一个模板数据变量
        $viewData=[
            'cates'=>$cates,
        ];
        //渲染视图
        $this->assign($viewData);
        return view();
    }
    //栏目添加
    public function add()
    {
        if (request()->isAjax()){
            $data=[
                'catename'=>input('post.catename'),
                'sort'=>input('post.sort')
            ];
            $result=model('Cate')->add($data);
            if ($result==1){
                $this->success('栏目添加成功','admin/cate/list');
            }else{
                $this->error($result);
            }
        }
        return view();
    }
}