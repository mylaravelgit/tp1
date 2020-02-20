<?php

namespace app\admin\controller;

use think\Controller;
use think\response\Json;
use think\Db;
class Article extends Base
{

    //文章列表
    public function list()
{
    $articles=Db::table('tp_article')->order('is_top', 'desc')->paginate(10);
//        $articles = model('article')->order(['is_top' => 'desc'])->paginate(10);
    //$articles=model('Cate')->select();
    $viewData=[
        'articles'=>$articles
    ];
    $this->assign($viewData);
    return view();
}
    //文章添加
    public function add()
    {
        if (request()->isAjax()){
            $data=[
                'title'=>input('post.title'),
                'tags'=>input('post.tags'),
                'is_top'=>input('post.is_top','0'),
                'cate_id'=>input('post.cateid'),
                'desc'=>input('post.desc'),
                'content'=>input('post.content'),
            ];
            $result=model('Article')->add($data);
            if ($result==1){
                $this->success('文章添加成功','admin/article/list');
            }else{
                $this->error($result);
            }
        }
        $cates=model('Cate')->select();
        $viewData=[
            'cates'=>$cates
        ];
        $this->assign($viewData);
        return view();
    }

    //推荐
    public function top()
    {
        $data=[
            'id'=>input('post.id'),
            'is_top'=>input('post.is_top')?0:1
        ];
        $result=model('Article')->top($data);
        if ($result==1){
            $this->success('操作成功','admin/article/list');
        }else{
            $this->error($result);
        }

    }
}
