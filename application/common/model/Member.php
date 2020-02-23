<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Member extends Model
{
    //
    use  SoftDelete;


    //只读字段
    protected $readonly=['username','email'];

    //会员添加
    public function add($data)
    {
        $validate=new \app\common\validate\Member();
        if (!$validate->scene('add')->check($data)){
            return $validate->getError();
        }
        $result=$this->allowField(true)->save($data);
        if ($result){
            return 1;

        }else{
            return ' 栏目添加失败';
        }

        return false ;
    }
}
