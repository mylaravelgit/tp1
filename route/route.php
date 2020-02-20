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

//Route::get('think', function () {
//    return 'hello,ThinkPHP5!';
//});
//
//Route::get('hello/:name', 'index/hello');
//
//return [
//
//];
Route::group('admin', function () {
    Route::rule('/','admin/index/login','get|post');
    Route::rule('register','admin/index/register','get|post');
    Route::rule('forget','admin/index/forget','get|post');
    Route::rule('reset','admin/index/reset','post');
    Route::rule('index','admin/home/index','get');
    Route::rule('logout','admin/home/logout','post');
    Route::rule('catelist','admin/cate/list','get');
    Route::rule('cateadd','admin/cate/add','get|post');
    Route::rule('catesort','admin/cate/sort','post');
    Route::rule('cateedit/[:id]','admin/cate/edit','get|post');
    Route::rule('cateedit','admin/cate/del','post');
    Route::rule('articlelist','admin/article/list','get|post');
    Route::rule('articleadd','admin/article/add','get|post');

});