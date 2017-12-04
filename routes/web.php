<?php
use Illuminate\Support\Facades\Redis;
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
    Route::get('/', 'Program\SystemController@dashboard')->middleware('ProgramCheckIsLogin');//系统首页
    Route::get('quit','Program\SystemController@quit');//退出系统

    //系统管理组(功能只有超级管理员能用)
    Route::group(['prefix'=>'dashboard'],function(){
        Route::get('account_add', 'Program\SystemController@account_add')->middleware('ProgramCheckIsLogin','ProgramCheckIsSuper');//添加账号路由
        Route::get('account_list', 'Program\SystemController@account_list')->middleware('ProgramCheckIsLogin','ProgramCheckIsSuper');//添加账号路由
        Route::get('operation_log','Program\SystemController@operation_log_list')->middleware('ProgramCheckIsLogin','ProgramCheckIsSuper','ProgramCheckSearchDate');//所有操作记录
        Route::get('login_log','Program\SystemController@login_log_list')->middleware('ProgramCheckIsLogin','ProgramCheckIsSuper','ProgramCheckSearchDate');//所有登陆记录
    });

    //个人中心组
    Route::group(['prefix'=>'personal'],function(){
        Route::get('password_edit', 'Program\PersonalController@password_edit')->middleware('ProgramCheckIsLogin');//修改密码路由
        Route::get('operation_log','Program\PersonalController@operation_log_list')->middleware('ProgramCheckIsLogin','ProgramCheckSearchDate');//我的操作记录
        Route::get('login_log','Program\PersonalController@login_log_list')->middleware('ProgramCheckIsLogin','ProgramCheckSearchDate');//所有登陆记录
    });

    //功能模块组
    Route::group(['prefix'=>'module'],function(){
        Route::get('module_add', 'Program\ModuleController@module_add')->middleware('ProgramCheckIsLogin');//修改密码路由
        Route::get('module_list', 'Program\ModuleController@module_list')->middleware('ProgramCheckIsLogin');//修改密码路由
    });

    //节点管理组
    Route::group(['prefix'=>'node'],function(){
        Route::get('node_add', 'Program\NodeController@node_add')->middleware('ProgramCheckIsLogin');//修改密码路由
        Route::get('node_list','Program\NodeController@node_list')->middleware('ProgramCheckIsLogin');//修改密码路由
    });

    //程序管理组
    Route::group(['prefix'=>'program'],function(){
        Route::get('program_add', 'Program\ProgramController@program_add')->middleware('ProgramCheckIsLogin');//修改密码路由
        Route::get('node_list','Program\NodeController@node_list')->middleware('ProgramCheckIsLogin');//修改密码路由
    });

    //登陆页面组
    Route::group(['prefix'=>'login'],function(){
        Route::get('/', 'Program\LoginController@display')->middleware('ProgramIsLogin');//登陆页面路由
        Route::get('captcha/{tmp}', 'Program\LoginController@captcha');//验证码路由
    });

    Route::group(['prefix'=>'ajax'],function(){
        Route::post('checklogin','Program\LoginController@checkLogin')->middleware('ProgramLoginPost');//提交登陆数据
        Route::post('account_add_check','Program\SystemController@account_add_check')->middleware('ProgramCheckIsLoginAjax','ProgramCheckIsSuperAjax','ProgramAccountAddCheck');//提交增加账号数据
        Route::post('account_edit','Program\SystemController@account_edit')->middleware('ProgramCheckIsLoginAjax','ProgramCheckIsSuperAjax');//获取账号数据并编辑
        Route::post('account_edit_check','Program\SystemController@account_edit_check')->middleware('ProgramCheckIsLoginAjax','ProgramCheckIsSuperAjax','ProgramAccountEditCheck');//提交编辑账号数据
        Route::post('account_lock','Program\SystemController@account_lock')->middleware('ProgramCheckIsLoginAjax','ProgramCheckIsSuperAjax','ProgramAccountLockCheck');//提交编辑账号数据;
        Route::post('password_edit_check','Program\PersonalController@password_edit_check')->middleware('ProgramCheckIsLoginAjax','ProgramEditPasswordCheck');//提交增加账号数据
        Route::post('node_add_check','Program\NodeController@node_add_check')->middleware('ProgramCheckIsLoginAjax','ProgramNodeAddCheck');//提交节点数据
        Route::post('node_edit','Program\NodeController@node_edit')->middleware('ProgramCheckIsLoginAjax');//获取节点数据并编辑
        Route::post('node_edit_check','Program\NodeController@node_edit_check')->middleware('ProgramCheckIsLoginAjax','ProgramNodeEditCheck');//检测编辑节点数据
        Route::post('module_add_check','Program\ModuleController@module_add_check')->middleware('ProgramCheckIsLoginAjax','ProgramModuleAddCheck');//提交功能模块数据
        Route::post('module_edit','Program\ModuleController@module_edit')->middleware('ProgramCheckIsLoginAjax');//获取功能模块数据并提交
        Route::post('module_edit_check','Program\ModuleController@module_edit_check')->middleware('ProgramCheckIsLoginAjax','ProgramModuleEditCheck');
    });
});
/********************程序管理系统*************************/

