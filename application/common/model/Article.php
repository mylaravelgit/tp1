<?php

namespace app\common\model;

use think\Db;
use think\Model;
use think\model\concern\SoftDelete;

class Article extends Model
{
    //
    use SoftDelete;

    public function add($data)
    {
        $validata=new \app\common\validate\Article();
        if (!$validata->scene('add')->check($data)){
            return $validata->getError();
        }
        $result= $this->allowField(true)->save($data);
        if ($result){
            return 1;
        }else{
            return '文章添加失败';
        }
    }

    //推荐
    public function top($data)
    {
        $validate=new \app\common\validate\Article();
        if (!$validate->scene('top')->check($data)){
            return $validate->getError();
        }
        $result=Db::table('tp_article')
            ->where('id','=',$data['id'])
            ->update(['is_top'=>$data['is_top']]);
//        $articleInfo=$this->find($data['id']);
//        $articleInfo->is_top=$data['is_top'];
//        $result=$articleInfo->save();
        if ($result){
            return 1;
        }else{
            return '操作失败';
        }
    }
}
