<?php
namespace app\index\controller;


class Index extends  Base
{
    public function index()
    {
        $where=[];
        $catename=null;
        if (input('?id')){
            $where=[
                'cate_id'=>input('id')
            ];
            $catename=model('Cate')->where('id',input('id'))->value('catename');
        }
        $articles=model('Article')->where($where)->order('create_time','desc')->paginate(5);
        $viewData=[
            'articles'=>$articles,
            'catename'=>$catename
        ];
        $this->assign($viewData);
        return view();
    }

    //注册
    public function register()
    {
        return view();
    }

}
