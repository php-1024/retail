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
        Route::get('join','Study\QueryBuliderController@select_join');//关联查询
        Route::get('union','Study\QueryBuliderController@select_union');//联合查询
        Route::get('where','Study\QueryBuliderController@select_where');//子语句
        Route::get('orwhere','Study\QueryBuliderController@select_orwhere');//or查询
        Route::get('between','Study\QueryBuliderController@select_between');//between,not between语句
        Route::get('in','Study\QueryBuliderController@select_in');//between,not between语句
        Route::get('cc','Study\QueryBuliderController@select_cc');//whereColumn 对比两个字段的值
        Route::get('gjwhere','Study\QueryBuliderController@select_gjwhere');//whereColumn 对比两个字段的值
        Route::get('exists','Study\QueryBuliderController@select_exists');//exist 使用select语句作为where查询 与in使用方法雷士
        Route::get('orderby','Study\QueryBuliderController@select_orderby');//正常排序,随机排序
        Route::get('groupby','Study\QueryBuliderController@select_groupby');//分组
        Route::get('having','Study\QueryBuliderController@select_having');//having查询
        Route::get('skip','Study\QueryBuliderController@select_skip');//offect,limit的两种用法
        Route::get('when','Study\QueryBuliderController@select_when');//带参数的条件语句when
        Route::get('ins','Study\QueryBuliderController@insertDB');//插入单条数据,插入多条数据，插入数据并获取ID
        Route::get('update','Study\QueryBuliderController@updateDB');//更新数据，字段自增自减，字段自增自减同时更新数据
        Route::get('delete','Study\QueryBuliderController@deleteDB');//删除数据
        Route::get('truncate','Study\QueryBuliderController@truncateDB');//清空数据,自增ID改为0，慎用
        Route::get('paginate','Study\QueryBuliderController@paginateDB');//清空数据,自增ID改为0，慎用
    });

    //ORM的使用
    Route::group(['prefix'=>'ormstudy'],function(){
        Route::get('getall','Study\OrmStudyController@getAll');//获取列表数据
        Route::get('getlist','Study\OrmStudyController@getList');//获取多条数据
        Route::get('getone','Study\OrmStudyController@getOne');//获取单条数据
        Route::get('getpage','Study\OrmStudyController@getPage');//获取分页
        Route::get('inssave','Study\OrmStudyController@ins_save');//插入或更新
        Route::get('update','Study\OrmStudyController@do_update');//批量更新
        Route::get('delete','Study\OrmStudyController@do_delete');//删除的几种方式
        Route::get('oneone','Study\OrmStudyController@one_one');//ORM关联一对一的关系
        Route::get('onemany','Study\OrmStudyController@one_many');//ORM关联一对多的关系
        Route::get('manymany','Study\OrmStudyController@many_many');//ORM关联多对多的关系
        Route::get('onethroughmany','Study\OrmStudyController@one_through_many');//ORM远程一对多的关系
        Route::get('ormsearch','Study\OrmStudyController@orm_search');
    });
});
/***************************框架学习整理资料部分**************************/

/***********************程序管理系统*********************/
Route::group(['prefix'=>'tooling'],function(){
    Route::get('/', 'Tooling\SystemController@dashboard')->middleware('ToolingCheck');//系统首页
    Route::get('quit','Tooling\SystemController@quit');//退出系统

    //系统管理组(功能只有超级管理员能用)
    Route::group(['prefix'=>'dashboard'],function(){
        Route::get('account_add', 'Tooling\SystemController@account_add')->middleware('ToolingCheck');//添加账号路由
        Route::get('account_list', 'Tooling\SystemController@account_list')->middleware('ToolingCheck');//账号列表路由
        Route::get('operation_log','Tooling\SystemController@operation_log_list')->middleware('ToolingCheck');//所有操作记录
        Route::get('login_log','Tooling\SystemController@login_log_list')->middleware('ToolingCheck');//所有登陆记录
    });

    //个人中心组
    Route::group(['prefix'=>'personal'],function(){
        Route::get('password_edit', 'Tooling\PersonalController@password_edit')->middleware('ToolingCheck');//修改密码路由
        Route::get('operation_log','Tooling\PersonalController@operation_log_list')->middleware('ToolingCheck');//我的操作记录
        Route::get('login_log','Tooling\PersonalController@login_log_list')->middleware('ToolingCheck');//所有登陆记录
    });

    //功能模块组
    Route::group(['prefix'=>'module'],function(){
        Route::get('module_add', 'Tooling\ModuleController@module_add')->middleware('ToolingCheck');//修改密码路由
        Route::get('module_list', 'Tooling\ModuleController@module_list')->middleware('ToolingCheck');//修改密码路由
    });

    //节点管理组
    Route::group(['prefix'=>'node'],function(){
        Route::get('node_add', 'Tooling\NodeController@node_add')->middleware('ToolingCheck');//修改密码路由
        Route::get('node_list','Tooling\NodeController@node_list')->middleware('ToolingCheck');//修改密码路由
    });

    //程序管理组
    Route::group(['prefix'=>'program'],function(){
        Route::get('program_add', 'Tooling\ProgramController@program_add')->middleware('ToolingCheck');//修改密码路由
        Route::get('program_list','Tooling\ProgramController@program_list')->middleware('ToolingCheck');//修改密码路由
        Route::get('menu_list','Tooling\ProgramController@menu_list')->middleware('ToolingCheck');//程序菜单路由
        Route::get('package_add','Tooling\ProgramController@package_add')->middleware('ToolingCheck');//添加配套路由
        Route::get('package_list','Tooling\ProgramController@package_list')->middleware('ToolingCheck');//配套列表路由
    });

    //登陆页面组
    Route::group(['prefix'=>'login'],function(){
        Route::get('/', 'Tooling\LoginController@display')->middleware('ToolingCheck');//登陆页面路由
        Route::get('captcha/{tmp}', 'Tooling\LoginController@captcha');//验证码路由
    });

    Route::group(['prefix'=>'ajax'],function(){
        Route::post('checklogin','Tooling\LoginController@checkLogin')->middleware('ToolingCheckAjax');//提交登陆数据
        Route::post('account_add_check','Tooling\SystemController@account_add_check')->middleware('ToolingCheckAjax');//提交增加账号数据
        Route::post('account_edit','Tooling\SystemController@account_edit')->middleware('ToolingCheckAjax');//获取账号数据并编辑
        Route::post('account_edit_check','Tooling\SystemController@account_edit_check')->middleware('ToolingCheckAjax');//提交编辑账号数据
        Route::post('account_lock','Tooling\SystemController@account_lock')->middleware('ToolingCheckAjax');//提交编辑账号数据;
        Route::post('password_edit_check','Tooling\PersonalController@password_edit_check')->middleware('ToolingCheckAjax');//提交增加账号数据
        Route::post('node_add_check','Tooling\NodeController@node_add_check')->middleware('ToolingCheckAjax');//提交节点数据
        Route::post('node_edit','Tooling\NodeController@node_edit')->middleware('ToolingCheckAjax');//获取节点数据并编辑
        Route::post('node_edit_check','Tooling\NodeController@node_edit_check')->middleware('ToolingCheckAjax');//检测编辑节点数据
        Route::post('module_add_check','Tooling\ModuleController@module_add_check')->middleware('ToolingCheckAjax');//提交功能模块数据
        Route::post('module_edit','Tooling\ModuleController@module_edit')->middleware('ToolingCheckAjax');//获取功能模块数据并提交
        Route::post('module_edit_check','Tooling\ModuleController@module_edit_check')->middleware('ToolingCheckAjax');
        Route::post('program_add_check','Tooling\ProgramController@program_add_check')->middleware('ToolingCheckAjax');//提交功能模块数据
        Route::post('program_parents_node','Tooling\ProgramController@program_parents_node')->middleware('ToolingCheckAjax');//获取上级程序ID
        Route::post('program_edit','Tooling\ProgramController@program_edit')->middleware('ToolingCheckAjax');//获取功能模块数据并提交
        Route::post('program_edit_check','Tooling\ProgramController@program_edit_check')->middleware('ToolingCheckAjax');//获取功能模块数据并提交
        Route::post('menu_add','Tooling\ProgramController@menu_add')->middleware('ToolingCheckAjax');//获取菜单添加页面
        Route::post('menu_add_check','Tooling\ProgramController@menu_add_check')->middleware('ToolingCheckAjax');//获取添加菜单数据并提交
        Route::post('menu_edit','Tooling\ProgramController@menu_edit')->middleware('ToolingCheckAjax');//获取菜单编辑页面
        Route::post('menu_edit_check','Tooling\ProgramController@menu_edit_check')->middleware('ToolingCheckAjax');//获取编辑菜单数据并提交
        Route::post('package_add_check','Tooling\ProgramController@package_add_check')->middleware('ToolingCheckAjax');//获取编辑菜单数据并提交
        Route::post('package_edit','Tooling\ProgramController@package_edit')->middleware('ToolingCheckAjax');//获取程序套餐编辑页面
        Route::post('package_edit_check','Tooling\ProgramController@package_edit_check')->middleware('ToolingCheckAjax');//获取编辑套餐数据并提交
        Route::post('node_delete','Tooling\NodeController@node_delete')->middleware('ToolingCheckAjax');//软删除节点
        Route::post('node_remove','Tooling\NodeController@node_remove')->middleware('ToolingCheckAjax');//软删除节点
        Route::post('module_delete','Tooling\ModuleController@module_delete')->middleware('ToolingCheckAjax');//软删除模块
        Route::post('module_remove','Tooling\ModuleController@module_remove')->middleware('ToolingCheckAjax');//硬删除模块
        Route::post('program_delete','Tooling\ProgramController@program_delete')->middleware('ToolingCheckAjax');//软删除程序
        Route::post('program_remove','Tooling\ProgramController@program_remove')->middleware('ToolingCheckAjax');//硬删除程序
        Route::post('menu_delete','Tooling\ProgramController@menu_delete')->middleware('ToolingCheckAjax');//软删除菜单
        Route::post('menu_remove','Tooling\ProgramController@menu_remove')->middleware('ToolingCheckAjax');//硬删除菜单
        Route::post('package_delete','Tooling\ProgramController@package_delete')->middleware('ToolingCheckAjax');//软删除套餐
        Route::post('package_remove','Tooling\ProgramController@package_remove')->middleware('ToolingCheckAjax');//硬删除套餐
    });
});
/********************程序管理系统*************************/

/**********************零壹管理系统*********************/
Route::group(['prefix'=>'zerone'],function(){
    Route::get('/', 'Zerone\DashboardController@display')->middleware('ZeroneCheck');//系统首页
    Route::get('quit','Zerone\DashboardController@quit');//退出系统


    //系统管理——参数设置
    Route::group(['prefix'=>'setup'],function(){
        Route::get('/','Zerone\SetupController@setup_show')->middleware('ZeroneCheck');//参数设置展示
        Route::get('setup_edit','Zerone\SetupController@setup_edit')->middleware('ZeroneCheck');//参数设置编辑
    });


    //登陆页面组
    Route::group(['prefix'=>'login'],function(){
        Route::get('/', 'Zerone\LoginController@display')->middleware('ZeroneCheck');//登陆页面路由
        Route::get('captcha/{tmp}', 'Zerone\LoginController@captcha');//验证码路由
    });

    //权限角色组
    Route::group(['prefix'=>'role'],function(){
        Route::get('role_add','Zerone\RoleController@role_add')->middleware('ZeroneCheck');//添加权限角色
        Route::get('role_list','Zerone\RoleController@role_list')->middleware('ZeroneCheck');//权限角色列表
    });

    //下级人员权限组
    Route::group(['prefix'=>'subordinate'],function(){
        Route::get('subordinate_add','Zerone\SubordinateController@subordinate_add')->middleware('ZeroneCheck');//添加下级人员
        Route::get('subordinate_list','Zerone\SubordinateController@subordinate_list')->middleware('ZeroneCheck');//下级人员列表
        Route::get('subordinate_structure','Zerone\SubordinateController@subordinate_structure')->middleware('ZeroneCheck');//下级人员结构
    });
    //服务商管理
    Route::group(['prefix'=>'proxy'],function(){
        Route::get('proxy_add','Zerone\ProxyController@proxy_add')->middleware('ZeroneCheck');//添加服务商
        Route::get('proxy_examinelist','Zerone\ProxyController@proxy_examinelist')->middleware('ZeroneCheck');//服务商审核列表
        Route::get('proxy_examine','Zerone\ProxyController@subordinate_structure')->middleware('ZeroneCheck');//服务商审核数据提交
        Route::get('proxy_list','Zerone\ProxyController@proxy_list')->middleware('ZeroneCheck');//服务商列表
    });

    //异步提交数据组
    Route::group(['prefix'=>'ajax'],function(){
        Route::post('login_check','Zerone\LoginController@login_check')->middleware('ZeroneCheckAjax');//提交登陆数据
        Route::post('role_add_check','Zerone\RoleController@role_add_check')->middleware('ZeroneCheckAjax');//提交添加权限角色数据
        Route::post('role_edit','Zerone\RoleController@role_edit')->middleware('ZeroneCheckAjax');//提交添加权限角色数据
    });
});
/********************零壹管理系统*************************/