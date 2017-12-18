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
/***************************框架学习整理资料部分***************************/
Route::get('zeott','Tooling\TestController@test');
Route::group(['prefix'=>'study'],function(){
    //Sql基本使用
    Route::group(['prefix'=>'basic'],function(){
        Route::get('ins','Study\SqlBasicController@insertDb');//测试SQL基本使用插入数据
        Route::get('sel','Study\SqlBasicController@selectDb');//测试SQL基本使用查询数据
        Route::get('upd','Study\SqlBasicController@updateDb');//测试SQL基本使用更新数据
        Route::get('del','Study\SqlBasicController@deleteDb');//测试SQL基本使用删除数据
        Route::get('state','Study\SqlBasicController@statementDb');//测试SQL基本使用与一般数据库语句
        Route::get('trans','Study\SqlBasicController@transactionDb');//测试数据库事务运作
    });
    //查询构造器的使用
    Route::group(['prefix'=>'builder'],function(){
        Route::get('getall','Study\QueryBuliderController@select_all');//查询构造器，查询所有数据
        Route::get('getfirst','Study\QueryBuliderController@select_first');//查询构造器，查询单条数据
        Route::get('getvalue','Study\QueryBuliderController@select_value');//查询构造器，查询单条数据的单个值
        Route::get('getpluck','Study\QueryBuliderController@select_pluck');//查询构造器，查询单条数据的单个值
        Route::get('count','Study\QueryBuliderController@select_count');//总行数
        Route::get('max','Study\QueryBuliderController@select_max');//列最大值
        Route::get('min','Study\QueryBuliderController@select_min');//列最小值
        Route::get('avg','Study\QueryBuliderController@select_avg');//列平均值
        Route::get('sum','Study\QueryBuliderController@select_sum');//列总和
        Route::get('column','Study\QueryBuliderController@select_column');//查询指定的多个列的值
        Route::get('column2','Study\QueryBuliderController@select_column2');//查询指定的多个列的值
        Route::get('distinct','Study\QueryBuliderController@select_distinct');//过滤查询结果中的重复值
    });
});
/***************************框架学习整理资料部分**************************/

/***********************程序管理系统*********************/
Route::group(['prefix'=>'tooling'],function(){
    Route::get('/', 'Tooling\SystemController@dashboard')->middleware('ToolingCheckIsLogin');//系统首页
    Route::get('quit','Tooling\SystemController@quit');//退出系统

    //系统管理组(功能只有超级管理员能用)
    Route::group(['prefix'=>'dashboard'],function(){
        Route::get('account_add', 'Tooling\SystemController@account_add')->middleware('ToolingCheckIsLogin','ToolingCheckIsSuper');//添加账号路由
        Route::get('account_list', 'Tooling\SystemController@account_list')->middleware('ToolingCheckIsLogin','ToolingCheckIsSuper');//添加账号路由
        Route::get('operation_log','Tooling\SystemController@operation_log_list')->middleware('ToolingCheckIsLogin','ToolingCheckIsSuper','ToolingCheckSearchDate');//所有操作记录
        Route::get('login_log','Tooling\SystemController@login_log_list')->middleware('ToolingCheckIsLogin','ToolingCheckIsSuper','ToolingCheckSearchDate');//所有登陆记录
    });

    //个人中心组
    Route::group(['prefix'=>'personal'],function(){
        Route::get('password_edit', 'Tooling\PersonalController@password_edit')->middleware('ToolingCheckIsLogin');//修改密码路由
        Route::get('operation_log','Tooling\PersonalController@operation_log_list')->middleware('ToolingCheckIsLogin','ToolingCheckSearchDate');//我的操作记录
        Route::get('login_log','Tooling\PersonalController@login_log_list')->middleware('ToolingCheckIsLogin','ToolingCheckSearchDate');//所有登陆记录
    });

    //功能模块组
    Route::group(['prefix'=>'module'],function(){
        Route::get('module_add', 'Tooling\ModuleController@module_add')->middleware('ToolingCheckIsLogin');//修改密码路由
        Route::get('module_list', 'Tooling\ModuleController@module_list')->middleware('ToolingCheckIsLogin');//修改密码路由
    });

    //节点管理组
    Route::group(['prefix'=>'node'],function(){
        Route::get('node_add', 'Tooling\NodeController@node_add')->middleware('ToolingCheckIsLogin');//修改密码路由
        Route::get('node_list','Tooling\NodeController@node_list')->middleware('ToolingCheckIsLogin');//修改密码路由
    });

    //程序管理组
    Route::group(['prefix'=>'program'],function(){
        Route::get('program_add', 'Tooling\ProgramController@program_add')->middleware('ToolingCheckIsLogin');//修改密码路由
        Route::get('program_list','Tooling\ProgramController@program_list')->middleware('ToolingCheckIsLogin');//修改密码路由
    });

    //登陆页面组
    Route::group(['prefix'=>'login'],function(){
        Route::get('/', 'Tooling\LoginController@display')->middleware('ToolingIsLogin');//登陆页面路由
        Route::get('captcha/{tmp}', 'Tooling\LoginController@captcha');//验证码路由
    });

    Route::group(['prefix'=>'ajax'],function(){
        Route::post('checklogin','Tooling\LoginController@checkLogin')->middleware('ToolingLoginPost');//提交登陆数据
        Route::post('account_add_check','Tooling\SystemController@account_add_check')->middleware('ToolingCheckIsLoginAjax','ToolingCheckIsSuperAjax','ToolingAccountAddCheck');//提交增加账号数据
        Route::post('account_edit','Tooling\SystemController@account_edit')->middleware('ToolingCheckIsLoginAjax','ToolingCheckIsSuperAjax');//获取账号数据并编辑
        Route::post('account_edit_check','Tooling\SystemController@account_edit_check')->middleware('ToolingCheckIsLoginAjax','ToolingCheckIsSuperAjax','ToolingAccountEditCheck');//提交编辑账号数据
        Route::post('account_lock','Tooling\SystemController@account_lock')->middleware('ToolingCheckIsLoginAjax','ToolingCheckIsSuperAjax','ToolingAccountLockCheck');//提交编辑账号数据;
        Route::post('password_edit_check','Tooling\PersonalController@password_edit_check')->middleware('ToolingCheckIsLoginAjax','ToolingEditPasswordCheck');//提交增加账号数据
        Route::post('node_add_check','Tooling\NodeController@node_add_check')->middleware('ToolingCheckIsLoginAjax','ToolingNodeAddCheck');//提交节点数据
        Route::post('node_edit','Tooling\NodeController@node_edit')->middleware('ToolingCheckIsLoginAjax');//获取节点数据并编辑
        Route::post('node_edit_check','Tooling\NodeController@node_edit_check')->middleware('ToolingCheckIsLoginAjax','ToolingNodeEditCheck');//检测编辑节点数据
        Route::post('module_add_check','Tooling\ModuleController@module_add_check')->middleware('ToolingCheckIsLoginAjax','ToolingModuleAddCheck');//提交功能模块数据
        Route::post('module_edit','Tooling\ModuleController@module_edit')->middleware('ToolingCheckIsLoginAjax');//获取功能模块数据并提交
        Route::post('module_edit_check','Tooling\ModuleController@module_edit_check')->middleware('ToolingCheckIsLoginAjax','ToolingModuleEditCheck');
        Route::post('program_add_check','Tooling\ProgramController@program_add_check')->middleware('ToolingCheckIsLoginAjax','ToolingProgramAddCheck');//提交功能模块数据
        Route::post('program_parents_node','Tooling\ProgramController@program_parents_node')->middleware('ToolingCheckIsLoginAjax');//获取上级程序ID
        Route::post('program_edit','Tooling\ProgramController@program_edit')->middleware('ToolingCheckIsLoginAjax');//获取功能模块数据并提交
        Route::post('program_edit_check','Tooling\ProgramController@program_edit_check')->middleware('ToolingCheckIsLoginAjax','ToolingProgramEditCheck');//获取功能模块数据并提交
    });
});
/********************程序管理系统*************************/

