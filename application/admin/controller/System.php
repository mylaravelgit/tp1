<?php

namespace app\admin\controller;

use think\Controller;

class System extends Controller
{
    //
    public function set()
    {
        if (request()->isAjax()){
            $data=[
                'id'=>input('post.id'),
                'webname'=>input('post.webname'),
                'copyright'=>input('post.copyright'),
            ];
            $result=model('System')->edit($data);
            if ($result==1){
                $this->success('设置成功','admin/home/index');
            }else{
                $this->error($result);
            }
        }
        $webInfo=model('System')->find();
        $viewData=[
            'webInfo'=>$webInfo
        ];
        $this->assign($viewData);
        return view();
    }
}
