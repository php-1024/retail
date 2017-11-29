<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*********************测试路由****************************/
Route::get('/', function () {
    return view('welcome');
})->middleware('CheckIsLogin');

//Route::get('login/captcha/{tmp}','dashboard\LoginController@captcha');
//Route::get('login','dashboard\LoginController@display');
//登陆页面路由组
Route::group(['prefix' => 'login','middleware' => 'CheckNotLogin'], function () {
    Route::get('/', 'dashboard\LoginController@display');
    Route::get('captcha/{tmp}', 'dashboard\LoginController@captcha');
});
Route::group(['prefix' => 'ajax'],function(){
    Route::post('checklogin','dashboard\LoginController@checkLogin')->middleware(['CheckNotLogin','DashBoardLoginPost']);
});
Route::group(['prefix'=>'redis'],function(){
    Route::get('study','dashboard\RedisController@study');
});

Route::get('tt',function(){
    $data = ['这是Laravel框架优美的打印函数','忙活了一天终于搭建成功啦。已将公司所有码农拉进码云项目组','码云地址：https://gitee.com/dzckzeo/lingyikeji_mvc.git','码农们准备撸起袖子干吧'];
    dump($data);
    return "零壹新科技Larael框架测试环境搭建成功啦";
});
/*********************测试路由****************************/

/***********************程序管理系统*********************/

Route::group(['prefix'=>'program'],function(){
    Route::get('/', function () {
        return '你好世界';
    })->middleware('ProgramCheckIsLogin');


    Route::group(['prefix'=>'login'],function(){
        Route::get('/', 'Program\LoginController@display')->middleware('ProgramIsLogin');//登陆页面路由
        Route::get('captcha/{tmp}', 'Program\LoginController@captcha');//验证码路由
    });

    Route::group(['prefix'=>'ajax'],function(){
        Route::post('checklogin','Program\LoginController@checkLogin')->middleware('PromgramLoginPost');//提交登陆数据
    });
});
/********************程序管理系统*************************/

