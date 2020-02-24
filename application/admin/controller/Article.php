<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use app\common\model\Article as ArticleModel;
class Article extends Base
{

    //文章列表
    public function list()
{
//    $articles=Db::table('tp_article')
//        ->join('tp_cate','tp_cate.id=tp_article.cate_id')
////        ->field('tp_article.id,tp_article.title,tp_article.is_top,tp_cate.catename')
//        ->order('is_top', 'desc')
//        ->paginate(10);
        $articles = model('article')->with('cate')->order(['is_top' => 'desc'])->paginate(10);
    //$articles=model('Cate')->select();
    $viewData=[
        'articles'=>$articles
    ];
//    dump($viewData);
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

    //编辑文章
    public function edit(){
        if (request()->isAjax()){
            $data=[
                'id'=>input('post.id'),
                'title'=>input('post.title'),
                'tags'=>input('post.tags'),
                'is_top'=>input('post.is_top','0'),
                'cate_id'=>input('post.cateid'),
                'desc'=>input('post.desc'),
                'content'=>input('post.content'),
            ];

            $result=model('Article')->edit($data);
            if ($result==1){
                $this->success('文章编辑成功','admin/article/list');
            }else{
                $this->error($result);
            }
        }

         $articleInfo=model('Article')->find(input('id'));
         $cates=model('Cate')->select();
         $vaewData=[
             'articleInfo'=>$articleInfo,
            'cates'=>$cates
         ];
           $this->assign($vaewData);
           return view();
        }

        //删除文章
    public function del()
    {
        $articleInfo=model('Article')->with('comments')
            ->find(input('post.id'));

        $result=$articleInfo->together('comments')->delete();
        if ($result){
            $this->success('文章删除成功','admin/article/list');
        }else{
            $this->error('文章删除失败');
        }
    }
}
