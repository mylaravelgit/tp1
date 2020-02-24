<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

//前台路由
Route::rule('cate/:id','index/index/index','get');
Route::rule('/','index/index/index','get');
Route::rule('article-:id','index/article/info','get');
Route::rule('register','index/index/register','get|post');


//后台路由
Route::group('admin', function () {
    Route::rule('/','admin/index/login','get|post');
    Route::rule('register','admin/index/register','get|post');
    Route::rule('forget','admin/index/forget','get|post');
    Route::rule('reset','admin/index/reset','post');
    Route::rule('index','admin/home/index','get');
    Route::rule('logout','admin/home/logout','post');
    //栏目
    Route::rule('catelist','admin/cate/list','get');
    Route::rule('cateadd','admin/cate/add','get|post');
    Route::rule('catesort','admin/cate/sort','post');
    Route::rule('cateedit/[:id]','admin/cate/edit','get|post');
    Route::rule('cateedit','admin/cate/del','post');
    //文章
    Route::rule('articlelist','admin/article/list','get');
    Route::rule('articleadd','admin/article/add','get|post');
    Route::rule('articletop','admin/article/top','post');
    Route::rule('articleedit/[:id]','admin/article/edit','get|post');
    Route::rule('articledel','admin/article/del','post');
    //会员
    Route::rule('memberlist','admin/member/all','get');
    Route::rule('memberadd','admin/member/add','get|post');
    Route::rule('memberedit/[:id]','admin/member/edit','get|post');
    Route::rule('memberdel','admin/member/del','post');
    //管理员
    Route::rule('adminlist','admin/admin/all','get');
    Route::rule('adminadd','admin/admin/add','get|post');
    Route::rule('adminstatus','admin/admin/status','post');
    Route::rule('adminedit/[:id]','admin/admin/edit','get|post');
    Route::rule('admindel','admin/admin/del','post');
    //评论
    Route::rule('comment','admin/comment/all','get');
    Route::rule('commentdel','admin/comment/del','post');

    //系统设置
    Route::rule('set','admin/system/set','get|post');
});