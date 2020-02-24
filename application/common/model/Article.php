<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;
use think\Db;


class Article extends Model
{
    //
    use SoftDelete;

    //关联栏目表
    public function cate()
    {
        return $this->belongsTo('Cate','cate_id','id');
    }
    //关联用户
    public function comments()
    {
        return $this->hasMany('Comment','article_id','id');
    }

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

    //编辑
    public function edit($data)
    {
        $validata=new \app\common\validate\Article();
        if (!$validata->scene('edit')->check($data)){
            return $validata->getError();
        }
        $articleInfo=$this->find($data['id']);
        $articleInfo->title=$data['title'];
        $articleInfo->tags=$data['tags'];
        $articleInfo->is_top=$data['is_top'];
        $articleInfo->cate_id=$data['cate_id'];
        $articleInfo->desc=$data['desc'];
        $articleInfo->content=$data['content'];

        $result= $articleInfo->save($data);
        if ($result){
            return 1;
        }else{
            return '文章编辑失败';
        }
    }
}
