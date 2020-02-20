<?php

namespace app\common\model;

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
}
