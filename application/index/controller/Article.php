<?php

namespace app\index\controller;

use think\Controller;

class Article extends Base
{
    //文章详情页
    public function info()
    {
        $articleInfo=model('Article')->with('comments,comments.member')->find(input('id'));
        $articleInfo->setInc('click');
        $viewData=[
            'articleInfo'=>$articleInfo
        ];
        $this->assign($viewData);
        return view();
    }
}
