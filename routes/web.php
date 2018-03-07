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
Route::any('/',function(){
    echo  "你好世界";
});
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
        Route::get('login_log','Tooling\SystemController@login_log_list')->middleware('ToolingCheck');//所有登录记录
    });

    //个人中心组
    Route::group(['prefix'=>'personal'],function(){
        Route::get('password_edit', 'Tooling\PersonalController@password_edit')->middleware('ToolingCheck');//修改密码路由
        Route::get('operation_log','Tooling\PersonalController@operation_log_list')->middleware('ToolingCheck');//我的操作记录
        Route::get('login_log','Tooling\PersonalController@login_log_list')->middleware('ToolingCheck');//所有登录记录
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

    //登录页面组
    Route::group(['prefix'=>'login'],function(){
        Route::get('/', 'Tooling\LoginController@display')->middleware('ToolingCheck');//登录页面路由
        Route::get('captcha/{tmp}', 'Tooling\LoginController@captcha');//验证码路由
    });

    Route::group(['prefix'=>'ajax'],function(){
        Route::post('checklogin','Tooling\LoginController@checkLogin')->middleware('ToolingCheckAjax');//提交登录数据


        Route::post('account_add_check','Tooling\SystemController@account_add_check')->middleware('ToolingCheckAjax');//提交增加账号数据
        Route::post('account_edit','Tooling\SystemController@account_edit')->middleware('ToolingCheckAjax');//获取账号数据并编辑
        Route::post('account_edit_check','Tooling\SystemController@account_edit_check')->middleware('ToolingCheckAjax');//提交编辑账号数据
        Route::post('account_lock','Tooling\SystemController@account_lock')->middleware('ToolingCheckAjax');//提交编辑账号数据;


        Route::post('password_edit_check','Tooling\PersonalController@password_edit_check')->middleware('ToolingCheckAjax');//修改密码


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
        Route::post('menu_second_get','Tooling\ProgramController@menu_second_get')->middleware('ToolingCheckAjax');//获取二级菜单
        Route::post('menu_add_check','Tooling\ProgramController@menu_add_check')->middleware('ToolingCheckAjax');//获取添加菜单数据并提交
        Route::post('menu_edit','Tooling\ProgramController@menu_edit')->middleware('ToolingCheckAjax');//获取菜单编辑页面
        Route::post('menu_edit_check','Tooling\ProgramController@menu_edit_check')->middleware('ToolingCheckAjax');//获取编辑菜单数据并提交
        Route::post('menu_edit_sort','Tooling\ProgramController@menu_edit_sort')->middleware('ToolingCheckAjax');//获取编辑菜单数据并提交

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

    //系统管理分组
    Route::group(['prefix'=>'dashboard'],function(){
        Route::get('setup','Zerone\DashboardController@setup')->middleware('ZeroneCheck');//参数设置展示
        Route::get('warzone','Zerone\DashboardController@warzone')->middleware('ZeroneCheck');//战区管理展示
        Route::get('structure','Zerone\DashboardController@structure')->middleware('ZeroneCheck');//人员结构
        Route::get('operation_log','Zerone\DashboardController@operation_log')->middleware('ZeroneCheck');//所有操作记录
        Route::get('login_log','Zerone\DashboardController@login_log')->middleware('ZeroneCheck');//所有登录记录
    });


    //个人中心组
    Route::group(['prefix'=>'personal'],function(){
        Route::get('/','Zerone\PersonalController@display')->middleware('ZeroneCheck');//个人资料
        Route::get('password_edit','Zerone\PersonalController@password_edit')->middleware('ZeroneCheck');//登录密码修改
        Route::get('safe_password','Zerone\PersonalController@safe_password')->middleware('ZeroneCheck');//安全密码设置
        Route::get('operation_log','Zerone\PersonalController@operation_log')->middleware('ZeroneCheck');//我的操作日志
        Route::get('login_log','Zerone\PersonalController@login_log')->middleware('ZeroneCheck');//我的登录日志
    });

    //登录页面组
    Route::group(['prefix'=>'login'],function(){
        Route::get('/', 'Zerone\LoginController@display')->middleware('ZeroneCheck');//登录页面路由
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
        Route::get('proxy_list','Zerone\ProxyController@proxy_list')->middleware('ZeroneCheck');//服务商列表
        Route::get('proxy_structure','Zerone\ProxyController@proxy_structure')->middleware('ZeroneCheck');//服务商人员架构
        Route::get('proxy_program','Zerone\ProxyController@proxy_program')->middleware('ZeroneCheck');//服务商程序管理
        Route::get('proxy_company','Zerone\ProxyController@proxy_company')->middleware('ZeroneCheck');//服务商商户划拨
    });
    //商户管理
    Route::group(['prefix'=>'company'],function(){
        Route::get('company_add','Zerone\CompanyController@company_add')->middleware('ZeroneCheck');//添加商户
        Route::get('company_examinelist','Zerone\CompanyController@company_examinelist')->middleware('ZeroneCheck');//商户审核列表
        Route::get('company_list','Zerone\CompanyController@company_list')->middleware('ZeroneCheck');//商户列表
        Route::get('company_structure','Zerone\CompanyController@company_structure')->middleware('ZeroneCheck');//商户人员架构
        Route::get('company_program','Zerone\CompanyController@company_program')->middleware('ZeroneCheck');//商户程序管理
        Route::get('company_store','Zerone\CompanyController@company_store')->middleware('ZeroneCheck');//商户划拨管理
    });
    //店铺管理
    Route::group(['prefix'=>'store'],function(){
        Route::get('store_add','Zerone\StoreController@store_add')->middleware('ZeroneCheck');//添加店铺
        Route::get('store_list','Zerone\StoreController@store_list')->middleware('ZeroneCheck');//店铺列表
        Route::get('store_structure','Zerone\StoreController@store_structure')->middleware('ZeroneCheck');//店铺人员架构
        Route::get('store_branchlist','Zerone\StoreController@store_branchlist')->middleware('ZeroneCheck');//分店管理
        Route::get('store_config','Zerone\StoreController@store_config')->middleware('ZeroneCheck');//分店设置参数
    });

    //异步提交数据组
    Route::group(['prefix'=>'ajax'],function(){
        Route::post('login_check','Zerone\LoginController@login_check')->middleware('ZeroneCheckAjax');//提交登录数据

        Route::post('role_add_check','Zerone\RoleController@role_add_check')->middleware('ZeroneCheckAjax');//提交添加权限角色数据
        Route::post('role_edit','Zerone\RoleController@role_edit')->middleware('ZeroneCheckAjax');//编辑权限角色弹出框
        Route::post('role_edit_check','Zerone\RoleController@role_edit_check')->middleware('ZeroneCheckAjax');//提交编辑权限角色数据
        Route::post('role_delete_comfirm','Zerone\RoleController@role_delete_comfirm');//删除权限角色弹出安全密码框
        Route::post('role_delete','Zerone\RoleController@role_delete')->middleware('ZeroneCheckAjax');//删除权限角色弹出安全密码框

        Route::post('warzone_add','Zerone\DashboardController@warzone_add')->middleware('ZeroneCheckAjax');//战区管理编辑战区
        Route::post('warzone_add_check','Zerone\DashboardController@warzone_add_check')->middleware('ZeroneCheckAjax');//战区管理编辑战区
        Route::post('warzone_delete','Zerone\DashboardController@warzone_delete')->middleware('ZeroneCheckAjax');//战区管理去确认删除战区
        Route::post('warzone_delete_confirm','Zerone\DashboardController@warzone_delete_confirm')->middleware('ZeroneCheckAjax');//战区管理删除战区弹出框
        Route::post('warzone_edit','Zerone\DashboardController@warzone_edit')->middleware('ZeroneCheckAjax');//战区管理编辑战区
        Route::post('warzone_edit_check','Zerone\DashboardController@warzone_edit_check')->middleware('ZeroneCheckAjax');//战区管理编辑战区
        Route::post('setup_edit_check','Zerone\DashboardController@setup_edit_check')->middleware('ZeroneCheckAjax');//提交编辑参数设置

        Route::post('password_edit_check','Zerone\PersonalController@password_edit_check')->middleware('ZeroneCheckAjax');//个人中心修改密码
        Route::post('safe_password_edit_check','Zerone\PersonalController@safe_password_edit_check')->middleware('ZeroneCheckAjax');//个人中心修改密码
        Route::post('personal_edit_check','Zerone\PersonalController@personal_edit_check')->middleware('ZeroneCheckAjax');//个人中心修改个人信息

        Route::post('proxy_add_check','Zerone\ProxyController@proxy_add_check')->middleware('ZeroneCheckAjax');//提交编辑参数设置
        Route::post('proxy_examine','Zerone\ProxyController@proxy_examine')->middleware('ZeroneCheckAjax');//服务商审核页面显示
        Route::post('proxy_examine_check','Zerone\ProxyController@proxy_examine_check')->middleware('ZeroneCheckAjax');//服务商审核数据提交
        Route::post('proxy_list_edit','Zerone\ProxyController@proxy_list_edit')->middleware('ZeroneCheckAjax');//服务商编辑显示页面
        Route::post('proxy_list_edit_check','Zerone\ProxyController@proxy_list_edit_check')->middleware('ZeroneCheckAjax');//服务商编辑数据提交
        Route::post('proxy_list_frozen','Zerone\ProxyController@proxy_list_frozen')->middleware('ZeroneCheckAjax');//服务商冻结显示页面
        Route::post('proxy_list_frozen_check','Zerone\ProxyController@proxy_list_frozen_check')->middleware('ZeroneCheckAjax');//服务商冻结提交功能
        Route::post('proxy_list_delete','Zerone\ProxyController@proxy_list_delete')->middleware('ZeroneCheckAjax');//服务商删除显示页面
        Route::post('proxy_assets','Zerone\ProxyController@proxy_assets')->middleware('ZeroneCheckAjax');//服务商程序管理划入划出显示页面
        Route::post('proxy_assets_check','Zerone\ProxyController@proxy_assets_check')->middleware('ZeroneCheckAjax');//服务商程序管理划入数据提交

        Route::post('subordinate_add_check','Zerone\SubordinateController@subordinate_add_check')->middleware('ZeroneCheckAjax');//添加下级人员数据提交
        Route::post('subordinate_edit','Zerone\SubordinateController@subordinate_edit')->middleware('ZeroneCheckAjax');//编辑下级人员弹出框
        Route::post('subordinate_edit_check','Zerone\SubordinateController@subordinate_edit_check')->middleware('ZeroneCheckAjax');//提交编辑下级人员数据提交
        Route::post('subordinate_lock_confirm','Zerone\SubordinateController@subordinate_lock_confirm')->middleware('ZeroneCheckAjax');//冻结下级人员安全密码输入框
        Route::post('subordinate_lock','Zerone\SubordinateController@subordinate_lock')->middleware('ZeroneCheckAjax');//提交冻结下级人员数据
        Route::post('subordinate_authorize','Zerone\SubordinateController@subordinate_authorize')->middleware('ZeroneCheckAjax');//下级人员授权管理弹出框
        Route::post('subordinate_authorize_check','Zerone\SubordinateController@subordinate_authorize_check')->middleware('ZeroneCheckAjax');//下级人员授权管理弹出框
        Route::post('subordinate_delete_confirm','Zerone\SubordinateController@subordinate_delete_confirm')->middleware('ZeroneCheckAjax');//删除下级人员安全密码输入框

        Route::post('quick_rule','Zerone\SubordinateController@quick_rule')->middleware('ZeroneCheckAjax');//添加下级人员快速授权
        Route::post('selected_rule','Zerone\SubordinateController@selected_rule')->middleware('ZeroneCheckAjax');//下级人员已经选中的权限


        Route::post('company_add_check','Zerone\CompanyController@company_add_check')->middleware('ZeroneCheckAjax');//商户申请提交编辑参数设置
        Route::post('company_examine','Zerone\CompanyController@company_examine')->middleware('ZeroneCheckAjax');//商户审核页面显示
        Route::post('company_examine_check','Zerone\CompanyController@company_examine_check')->middleware('ZeroneCheckAjax');//商户审核提交数据
        Route::post('company_list_edit','Zerone\CompanyController@company_list_edit')->middleware('ZeroneCheckAjax');//商户编辑页面显示
        Route::post('company_list_edit_check','Zerone\CompanyController@company_list_edit_check')->middleware('ZeroneCheckAjax');//商户编辑数据提交
        Route::post('company_list_frozen','Zerone\CompanyController@company_list_frozen')->middleware('ZeroneCheckAjax');//商户冻结页面显示
        Route::post('company_list_frozen_check','Zerone\CompanyController@company_list_frozen_check')->middleware('ZeroneCheckAjax');//商户冻结数据提交
        Route::post('company_list_delete','Zerone\CompanyController@company_list_delete')->middleware('ZeroneCheckAjax');//商户删除页面显示
        Route::post('company_assets','Zerone\CompanyController@company_assets')->middleware('ZeroneCheckAjax');//商户程序管理划入划出显示页面
        Route::post('company_assets_check','Zerone\CompanyController@company_assets_check')->middleware('ZeroneCheckAjax');//商户程序管理划入数据提交

        //添加店铺
        Route::post('store_insert','Zerone\StoreController@store_insert')->middleware('ZeroneCheckAjax');               //添加店铺ajax显示页面
        Route::post('store_insert_check','Zerone\StoreController@store_insert_check')->middleware('ZeroneCheckAjax');   //添加店铺数据提交

    });
});
/********************零壹管理系统*************************/

/**********************服务商管理系统*********************/
Route::group(['prefix'=>'proxy'],function(){

    //登录页面组
    Route::group(['prefix'=>'login'],function(){
        Route::get('/', 'Proxy\LoginController@display')->middleware('ProxyCheck');//登录页面路由
        Route::get('captcha/{tmp}', 'Proxy\LoginController@captcha');//验证码路由
    });


    Route::get('/', 'Proxy\SystemController@display')->middleware('ProxyCheck');//系统首页
    Route::get('switch_status', 'Proxy\SystemController@switch_status')->middleware('ProxyCheck');//超级管理员切换服务商
    Route::get('quit', 'Proxy\SystemController@quit');//退出系统

    //系统管理分组
    Route::group(['prefix'=>'system'],function(){
        Route::post('select_proxy','Proxy\SystemController@select_proxy')->middleware('ProxyCheck');//超级管理员选择登入的服务商
        Route::get('setup','Proxy\SystemController@setup')->middleware('ProxyCheck');//服务商参数设置
        Route::get('proxy_info','Proxy\SystemController@proxy_info')->middleware('ProxyCheck');//服务商信息设置
        Route::get('proxy_structure','Proxy\SystemController@proxy_structure')->middleware('ProxyCheck');//服务商人员结构
        Route::get('operationlog','Proxy\SystemController@operationlog')->middleware('ProxyCheck');//操作日志
        Route::get('loginlog','Proxy\SystemController@loginlog')->middleware('ProxyCheck');//登录日志
    });
    //个人信息分组
    Route::group(['prefix'=>'persona'],function(){
        Route::get('account_info','Proxy\PersonaController@account_info')->middleware('ProxyCheck');//个人信息修改
        Route::get('safe_password','Proxy\PersonaController@safe_password')->middleware('ProxyCheck');//安全密码修改
        Route::get('password','Proxy\PersonaController@password')->middleware('ProxyCheck');//登入密码修改
        Route::get('myoperationlog','Proxy\PersonaController@myoperationlog')->middleware('ProxyCheck');//我的操作记录
        Route::get('myloginlog','Proxy\PersonaController@myloginlog')->middleware('ProxyCheck');//我的登入记录
    });
    //下级人员管理--权限角色组
    Route::group(['prefix'=>'role'],function(){
        Route::get('role_add','Proxy\RoleController@role_add')->middleware('ProxyCheck');//添加权限角色
        Route::get('role_list','Proxy\RoleController@role_list')->middleware('ProxyCheck');//权限角色列表
    });
    //下级人员管理--添加组
    Route::group(['prefix'=>'subordinate'],function(){
        Route::get('subordinate_add','Proxy\SubordinateController@subordinate_add')->middleware('ProxyCheck');//添加下级人员
        Route::get('subordinate_list','Proxy\SubordinateController@subordinate_list')->middleware('ProxyCheck');//下级人员列表
        Route::get('subordinate_structure','Proxy\SubordinateController@subordinate_structure')->middleware('ProxyCheck');//下级人员结构
    });

    //系统资产管理
    Route::group(['prefix'=>'program'],function(){
        Route::get('program_list','Proxy\ProgramController@program_list')->middleware('ProxyCheck');//资产
        Route::get('program_log','Proxy\ProgramController@program_log')->middleware('ProxyCheck');//权限角色列表
    });

    //下辖商户管理
    Route::group(['prefix'=>'company'],function(){
        Route::get('company_register','Proxy\CompanyController@company_register')->middleware('ProxyCheck');//商户注册列表
        Route::get('company_list','Proxy\CompanyController@company_list')->middleware('ProxyCheck');//商户列表
        Route::get('company_structure','Proxy\CompanyController@company_structure')->middleware('ProxyCheck');//店铺结构
        Route::get('company_program','Proxy\CompanyController@company_program')->middleware('ProxyCheck');//程序划拨
    });

    //异步提交数据组
    Route::group(['prefix'=>'ajax'],function(){
        Route::post('login_check','Proxy\LoginController@login_check')->middleware('ProxyCheckAjax');//提交登录数据
        Route::post('proxy_info_check','Proxy\SystemController@proxy_info_check')->middleware('ProxyCheckAjax');//提交公司信息修改

        Route::post('account_info_check','Proxy\PersonaController@account_info_check')->middleware('ProxyCheckAjax');//个人信息修改
        Route::post('safe_password_check','Proxy\PersonaController@safe_password_check')->middleware('ProxyCheckAjax');//安全密码设置
        Route::post('password_check','Proxy\PersonaController@password_check')->middleware('ProxyCheckAjax');//登入密码修改

        Route::post('company_assets','Proxy\CompanyController@company_assets')->middleware('ProxyCheckAjax');//程序划入划出显示页面
        Route::post('company_assets_check','Proxy\CompanyController@company_assets_check')->middleware('ProxyCheckAjax');//程序划入划出功能提交

        Route::post('role_add_check','Proxy\RoleController@role_add_check')->middleware('ProxyCheckAjax');;////提交添加权限角色数据
        Route::post('role_edit','Proxy\RoleController@role_edit')->middleware('ProxyCheckAjax');//编辑权限角色弹出框
        Route::post('role_edit_check','Proxy\RoleController@role_edit_check')->middleware('ProxyCheckAjax');//编辑权限角色弹出框
        Route::post('role_delete','Proxy\RoleController@role_delete')->middleware('ProxyCheckAjax');;//删除权限角色弹出安全密码框
        Route::post('role_delete_check','Proxy\RoleController@role_delete_check')->middleware('ProxyCheckAjax');//删除权限角色弹出安全密码框

        Route::post('subordinate_add_check','Proxy\SubordinateController@subordinate_add_check')->middleware('ProxyCheckAjax');//添加下级人员数据提交
        Route::post('subordinate_edit','Proxy\SubordinateController@subordinate_edit')->middleware('ProxyCheckAjax');//下级人员列表编辑用户弹出框
        Route::post('subordinate_edit_check','Proxy\SubordinateController@subordinate_edit_check')->middleware('ProxyCheckAjax');//下级人员列表编辑功能提交
        Route::post('subordinate_authorize','Proxy\SubordinateController@subordinate_authorize')->middleware('ProxyCheckAjax');//下级人员列表用户授权显示页面
        Route::post('subordinate_authorize_check','Proxy\SubordinateController@subordinate_authorize_check')->middleware('ProxyCheckAjax');//下级人员列表用户授权功能提交页面
        Route::post('subordinate_delete','Proxy\SubordinateController@subordinate_delete')->middleware('ProxyCheckAjax');//下级人员列表删除用户显示页面
        Route::post('subordinate_lock','Proxy\SubordinateController@subordinate_lock')->middleware('ProxyCheckAjax');//冻结下级人员显示页面
        Route::post('subordinate_lock_check','Proxy\SubordinateController@subordinate_lock_check')->middleware('ProxyCheckAjax');//冻结下级人员功能提交

        Route::post('quick_rule','Proxy\SubordinateController@quick_rule')->middleware('ProxyCheckAjax');//添加下级人员快速授权
        Route::post('selected_rule','Proxy\SubordinateController@selected_rule')->middleware('ProxyCheckAjax');//下级人员已经选中的权限出框

    });
});
/********************服务商管理系统*************************/


/**********************商户管理系统*********************/
Route::group(['prefix'=>'company'],function(){

    //登录页面组
    Route::group(['prefix'=>'login'],function(){
        Route::get('/', 'Company\LoginController@display')->middleware('CompanyCheck');//登录页面路由
        Route::get('captcha/{tmp}', 'Company\LoginController@captcha');//验证码路由
    });

    //系统首页&&公司资料
    Route::group(['prefix'=>'/'],function(){
        Route::any('/', 'Company\AccountcenterController@display')->middleware('CompanyCheck');                     //首页面路由
        Route::get('quit', 'Company\AccountcenterController@quit');                                                 //退出系统
        Route::get('company_list', 'Company\AccountcenterController@company_list')->middleware('CompanyCheck');     //商户列表
        Route::get('company_switch', 'Company\AccountcenterController@company_switch')->middleware('CompanyCheck'); //超级管理员退出当前商户
    });

    //账户中心
    Route::group(['prefix'=>'account'],function(){
        Route::get('password', 'Company\AccountcenterController@password')->middleware('CompanyCheck');             //登录密码页面
        Route::get('safe_password', 'Company\AccountcenterController@safe_password')->middleware('CompanyCheck');   //安全密码
        Route::get('profile', 'Company\AccountcenterController@profile')->middleware('CompanyCheck');               //安全密码
        Route::get('operation_log', 'Company\AccountcenterController@operation_log')->middleware('CompanyCheck');   //账户中心个人操作日志
        Route::get('login_log', 'Company\AccountcenterController@login_log')->middleware('CompanyCheck');           //账户中心个人登录日志
    });

    //店铺管理
    Route::group(['prefix'=>'store'],function(){
        Route::get('store_add', 'Company\StoreController@store_add')->middleware('CompanyCheck');                   //店铺管理创建店铺
        Route::get('store_add_second', 'Company\StoreController@store_add_second')->middleware('CompanyCheck');     //店铺管理立即开店
        Route::get('store_list', 'Company\StoreController@store_list')->middleware('CompanyCheck');                 //店铺管理
    });

    //异步提交数据组
    Route::group(['prefix'=>'ajax'],function(){
        Route::post('login_check','Company\LoginController@login_check')->middleware('CompanyCheckAjax');                                   //提交登录数据
        Route::post('company_select', 'Company\AccountcenterController@company_select')->middleware('CompanyCheckAjax');                    //选择商户
        Route::post('compant_info_edit_check', 'Company\AccountcenterController@compant_info_edit_check')->middleware('CompanyCheckAjax');  //（公司资料）商户资料修改
        Route::post('profile_edit_check', 'Company\AccountcenterController@profile_edit_check')->middleware('CompanyCheckAjax');            //个人账号信息修改
        Route::post('password_edit_check', 'Company\AccountcenterController@password_edit_check')->middleware('CompanyCheckAjax');          //密码检测
        Route::post('safe_password_edit_check', 'Company\AccountcenterController@safe_password_edit_check')->middleware('CompanyCheckAjax');//安全密码检测
        Route::post('store_add_second_check', 'Company\StoreController@store_add_second_check')->middleware('CompanyCheckAjax');//安全密码检测
    });
});

Route::group(['prefix'=>'api'],function() {

    //登录页面组
    Route::group(['prefix' => 'wechat'], function () {
        Route::any('response/{appid}', 'Api\WechatController@response');//开放平台控制公众平台回复函数
        Route::any('open', 'Api\WechatController@open');//接受公众号收授权推送消息
        Route::any('auth', 'Api\WechatController@auth');//公众号授权链接页面
        Route::any('redirect', 'Api\WechatController@redirect');//公众号授权回调链接
        Route::any('web_redirect', 'Api\WechatController@web_redirect');//网页授权回调路由
        Route::any('open_web_redirect','Api\WechatController@open_web_redirect');
        Route::any('test', 'Api\WechatController@test');//测试函数
    });
});
/********************商户管理系统*************************/

/**********************店铺系统*********************/
Route::group(['prefix'=>'catering'],function(){

    //登录页面组
    Route::group(['prefix'=>'login'],function(){
        Route::get('/', 'Catering\LoginController@display')->middleware('CateringCheck');                               //登录页面路由
        Route::get('captcha/{tmp}', 'Catering\LoginController@captcha');                                                //验证码路由
    });

    Route::get('/', 'Catering\ShopController@display')->middleware('CateringCheck');                                    //系统首页
    Route::get('switch_status', 'Catering\ShopController@switch_status')->middleware('CateringCheck');                  //超级管理员切换服务商
    Route::get('quit', 'Catering\ShopController@quit');                                                                 //退出系统
    Route::post('select_shop','Catering\ShopController@select_shop')->middleware('CateringCheck');                      //超级管理员选择登入的服务商


    //账号中心
    Route::group(['prefix'=>'account'],function(){
        Route::get('profile', 'Catering\AccountController@profile')->middleware('CateringCheck');                       //账号信息
        Route::get('password', 'Catering\AccountController@password')->middleware('CateringCheck');                     //登入密码修改
        Route::get('safe_password', 'Catering\AccountController@safe_password')->middleware('CateringCheck');           //安全密码设置
        Route::get('message_setting', 'Catering\AccountController@message_setting')->middleware('CateringCheck');       //消息推送设置
        Route::get('operation_log', 'Catering\AccountController@operation_log')->middleware('CateringCheck');           //操作日记
        Route::get('login_log', 'Catering\AccountController@login_log')->middleware('CateringCheck');                   //登入日记
    });

    //公众号管理
    Route::group(['prefix'=>'subscription'],function(){
        Route::get('setting', 'Catering\SubscriptionController@setting')->middleware('CateringCheck');                              //公众号设置
        Route::get('material_image', 'Catering\SubscriptionController@material_image')->middleware('CateringCheck');                //图片素材
        Route::get('material_writing', 'Catering\SubscriptionController@material_writing')->middleware('CateringCheck');            //图文素材
        Route::get('material_writing_one', 'Catering\SubscriptionController@material_writing_one')->middleware('CateringCheck');    //单条图文
        Route::get('material_writing_one_edit', 'Catering\SubscriptionController@material_writing_one_edit')->middleware('CateringCheck');  //单条图文编辑
        Route::get('material_writing_many', 'Catering\SubscriptionController@material_writing_many')->middleware('CateringCheck');  //多条图文
        Route::get('material_writing_many_edit', 'Catering\SubscriptionController@material_writing_many_edit')->middleware('CateringCheck');//多条图文编辑
    });

    //公众号管理--消息管理 && 菜单管理
    Route::group(['prefix'=>'news'],function(){
        Route::get('message', 'Catering\NewsController@message')->middleware('CateringCheck');                          //关键词自动回复
        Route::get('message_attention', 'Catering\NewsController@message_attention')->middleware('CateringCheck');      //关注后自动回复
        Route::get('message_default', 'Catering\NewsController@message_default')->middleware('CateringCheck');          //默认回复
        Route::get('message_mass', 'Catering\NewsController@message_mass')->middleware('CateringCheck');                //消息群发

    });

    //公众号管理--菜单管理
    Route::group(['prefix'=>'menu'],function(){
        Route::get('menu_customize', 'Catering\MenuController@menu_customize')->middleware('CateringCheck');            //自定义菜单
        Route::get('menu_different', 'Catering\MenuController@menu_different')->middleware('CateringCheck');            //个性化菜单

    });

    //用户管理
    Route::group(['prefix'=>'user'],function(){
        Route::get('user_tag', 'Catering\UserController@user_tag')->middleware('CateringCheck');                        //粉丝标签管理
        Route::get('user_list', 'Catering\UserController@user_list')->middleware('CateringCheck');                      //粉丝用户管理
        Route::get('user_timeline', 'Catering\UserController@user_timeline')->middleware('CateringCheck');              //粉丝用户足迹
    });

    //下属管理--权限角色组
    Route::group(['prefix'=>'role'],function(){
        Route::get('role_add','Catering\RoleController@role_add')->middleware('CateringCheck');                         //添加权限角色
        Route::get('role_list','Catering\RoleController@role_list')->middleware('CateringCheck');                       //权限角色列表
    });


    //下属管理--添加组
    Route::group(['prefix'=>'subordinate'],function(){
        Route::get('subordinate_add','Catering\SubordinateController@subordinate_add')->middleware('CateringCheck');    //添加下级人员
        Route::get('subordinate_list','Catering\SubordinateController@subordinate_list')->middleware('CateringCheck');  //下级人员列表
    });

    //财务管理
    Route::group(['prefix'=>'finance'],function(){
        Route::get('balance','Catering\FinanceController@balance')->middleware('CateringCheck');                        //余额管理
        Route::get('balance_recharge','Catering\FinanceController@balance_recharge')->middleware('CateringCheck');      //余额详情
        Route::get('credit','Catering\FinanceController@credit')->middleware('CateringCheck');                          //积分管理
        Route::get('credit_recharge','Catering\FinanceController@credit_recharge')->middleware('CateringCheck');        //充值扣费
        Route::get('commission','Catering\FinanceController@commission')->middleware('CateringCheck');                  //佣金管理
    });

    //支付设置
    Route::group(['prefix'=>'payment'],function(){
        Route::get('wechat_setting','Catering\PaymentController@wechat_setting')->middleware('CateringCheck');          //微信支付
        Route::get('zerone_setting','Catering\PaymentController@zerone_setting')->middleware('CateringCheck');          //零舍壹得
        Route::get('sheng_setting','Catering\PaymentController@sheng_setting')->middleware('CateringCheck');            //盛付通
        Route::get('kuai_setting','Catering\PaymentController@kuai_setting')->middleware('CateringCheck');              //快付通
    });

    //商品管理
    Route::group(['prefix'=>'goods'],function(){
        Route::get('goods_category','Catering\GoodsController@goods_category')->middleware('CateringCheck');            //商品分类查询
        Route::get('goods_list','Catering\GoodsController@goods_list')->middleware('CateringCheck');                    //商品查询
        Route::get('goods_detail','Catering\GoodsController@goods_detail')->middleware('CateringCheck');                //商品查看详情
    });

    //总分店管理
    Route::group(['prefix'=>'store'],function(){
        Route::get('branch_create','Catering\StoreController@branch_create')->middleware('CateringCheck');              //创建总分店
        Route::get('branch_list','Catering\StoreController@branch_list')->middleware('CateringCheck');                  //总分店管理
    });
    //营销管理
    Route::group(['prefix'=>'card'],function(){
        Route::get('card_add','Catering\CardController@card_add')->middleware('CateringCheck');                         //添加会员卡
        Route::get('card_list','Catering\CardController@card_list')->middleware('CateringCheck');                       //会员卡管理
        Route::get('card_goods','Catering\CardController@card_goods')->middleware('CateringCheck');                     //调整适用商品
    });

    //异步提交数据组
    Route::group(['prefix'=>'ajax'],function(){
        Route::post('login_check','Catering\LoginController@login_check')->middleware('CateringCheckAjax');             //提交登录数据

        //账号中心
        Route::post('profile_check','Catering\AccountController@profile_check')->middleware('CateringCheckAjax');       //提交登录数据
        Route::post('safe_password_check','Catering\AccountController@safe_password_check')->middleware('CateringCheckAjax');//安全密码数据提交
        Route::post('password_check','Catering\AccountController@password_check')->middleware('CateringCheckAjax');     //安全密码数据提交

        //权限角色
        Route::post('role_add_check','Catering\RoleController@role_add_check')->middleware('CateringCheckAjax');        //提交添加权限角色数据
        Route::post('role_edit','Catering\RoleController@role_edit')->middleware('CateringCheckAjax');                  //编辑权限角色弹出框
        Route::post('role_edit_check','Catering\RoleController@role_edit_check')->middleware('CateringCheckAjax');      //编辑权限角色弹出框
        Route::post('role_delete','Catering\RoleController@role_delete')->middleware('CateringCheckAjax');              //删除权限角色弹出安全密码框
        Route::post('role_delete_check','Catering\RoleController@role_delete_check')->middleware('CateringCheckAjax');  //删除权限角色弹出安全密码框

        //下属管理--添加组
        Route::post('subordinate_add_check','Catering\SubordinateController@subordinate_add_check')->middleware('CateringCheckAjax');//添加下级人员数据提交
        Route::post('subordinate_edit','Catering\SubordinateController@subordinate_edit')->middleware('CateringCheckAjax');//下级人员列表编辑用户弹出框
        Route::post('subordinate_edit_check','Catering\SubordinateController@subordinate_edit_check')->middleware('CateringCheckAjax');//下级人员列表编辑功能提交
        Route::post('subordinate_authorize','Catering\SubordinateController@subordinate_authorize')->middleware('CateringCheckAjax');//下级人员列表用户授权显示页面
        Route::post('subordinate_authorize_check','Catering\SubordinateController@subordinate_authorize_check')->middleware('CateringCheckAjax');//下级人员列表用户授权功能提交页面
        Route::post('subordinate_delete','Catering\SubordinateController@subordinate_delete')->middleware('CateringCheckAjax');//下级人员列表删除用户显示页面
        Route::post('subordinate_lock','Catering\SubordinateController@subordinate_lock')->middleware('CateringCheckAjax');//冻结下级人员显示页面
        Route::post('subordinate_lock_check','Catering\SubordinateController@subordinate_lock_check')->middleware('CateringCheckAjax');//冻结下级人员功能提交

        Route::post('quick_rule','Catering\SubordinateController@quick_rule')->middleware('CateringCheckAjax');//添加下级人员快速授权
        Route::post('selected_rule','Catering\SubordinateController@selected_rule')->middleware('CateringCheckAjax');//下级人员已经选中的权限出框

        //总分店管理
        Route::post('branch_create_check','Catering\StoreController@branch_create_check')->middleware('CateringCheckAjax');//总分店添加功能提交

    });
});
/**********************店铺系统*********************/


/**********************餐饮分店系统*********************/
Route::group(['prefix'=>'branch'],function(){
    //登录页面组
    Route::group(['prefix'=>'login'],function(){
        Route::get('/', 'Branch\LoginController@display')->middleware('BranchCheck');//登录页面路由
        Route::get('captcha/{tmp}', 'Branch\LoginController@captcha');//验证码路由
    });
    Route::get('/', 'Branch\DisplayController@display')->middleware('BranchCheck');//分店首页
    Route::get('quit', 'Branch\LoginController@quit');                                                 //退出系统
    Route::get('branch_list', 'Branch\DisplayController@branch_list')->middleware('BranchCheck');      //分店列表
    Route::get('branch_switch', 'Branch\DisplayController@branch_switch')->middleware('BranchCheck'); //超级管理员退出当前店铺

    //账户中心
    Route::group(['prefix'=>'account'],function(){
        Route::get('profile', 'Branch\AccountController@profile')->middleware('BranchCheck'); //账号中心-账户信息
        Route::get('safe_password', 'Branch\AccountController@safe_password')->middleware('BranchCheck');//安全密码
        Route::get('message_setting', 'Branch\AccountController@message_setting')->middleware('BranchCheck');//消息接收设置
        Route::get('password', 'Branch\AccountController@password')->middleware('BranchCheck');          //登录密码页面
        Route::get('operation_log', 'Branch\AccountController@operation_log')->middleware('BranchCheck');   //账户中心个人操作日志
        Route::get('login_log', 'Branch\AccountController@login_log')->middleware('BranchCheck');           //账户中心个人登录日志
    });

    //收银台
    Route::get('cashier', 'Branch\CashierController@cashier')->middleware('BranchCheck');   //收银台

    //商品管理
    Route::group(['prefix'=>'goods'],function(){
        Route::get('category_add', 'Branch\GoodsController@category_add')->middleware('BranchCheck');   //商品管理-添加商品分类
        Route::get('category_list', 'Branch\GoodsController@category_list')->middleware('BranchCheck'); //商品管理-商品分类列表
        Route::get('goods_add', 'Branch\GoodsController@goods_add')->middleware('BranchCheck');         //商品管理-添加商品
        Route::get('goods_edit', 'Branch\GoodsController@goods_edit')->middleware('BranchCheck');       //商品管理-编辑商品
        Route::get('goods_list', 'Branch\GoodsController@goods_list')->middleware('BranchCheck');       //商品管理-商品列表
        Route::get('goods_copy', 'Branch\GoodsController@goods_copy')->middleware('BranchCheck');       //商品管理-拷贝其他分店商品
    });

    //订单管理
    Route::group(['prefix'=>'order'],function(){
        Route::get('order_spot', 'Branch\OrderController@order_spot')->middleware('BranchCheck');                       //订单管理-现场订单
        Route::get('order_spot_detail', 'Branch\OrderController@order_spot_detail')->middleware('BranchCheck');         //订单管理-现场订单详情
        Route::get('order_takeout', 'Branch\OrderController@order_takeout')->middleware('BranchCheck');                 //订单管理-外卖订单
        Route::get('order_takeout_detail', 'Branch\OrderController@order_takeout_detail')->middleware('BranchCheck');   //订单管理-外卖订单详情
        Route::get('order_appointment', 'Branch\OrderController@order_appointment')->middleware('BranchCheck');         //预约管理
    });

    //设备管理
    Route::group(['prefix'=>'device'],function(){
        Route::get('room_add', 'Branch\DeviceController@room_add')->middleware('BranchCheck');   //设备管理-添加包厢
        Route::get('room_list', 'Branch\DeviceController@room_list')->middleware('BranchCheck'); //设备管理-包厢管理
        Route::get('table_add', 'Branch\DeviceController@table_add')->middleware('BranchCheck'); //设备管理-添加餐桌
        Route::get('table_list', 'Branch\DeviceController@table_list')->middleware('BranchCheck'); //设备管理-餐桌管理
        Route::get('printer_add', 'Branch\DeviceController@printer_add')->middleware('BranchCheck'); //设备管理-添加打印机
        Route::get('printer_list', 'Branch\DeviceController@printer_list')->middleware('BranchCheck'); //设备管理-打印机管理
        Route::get('printer_goods', 'Branch\DeviceController@printer_goods')->middleware('BranchCheck'); //设备管理-打印机关联商品
    });






    //用户管理
    Route::group(['prefix'=>'user'],function(){
        Route::get('user_tag', 'Branch\UserController@user_tag')->middleware('BranchCheck');            //用户管理-粉丝标签管理
        Route::get('user_list', 'Branch\UserController@user_list')->middleware('BranchCheck');          //用户管理-粉丝用户管理
        Route::get('user_timeline', 'Branch\UserController@user_timeline')->middleware('BranchCheck');  //用户管理-粉丝足迹管理
    });

    //财务管理
    Route::group(['prefix'=>'finance'],function(){
        Route::get('balance', 'Branch\FinanceController@balance')->middleware('BranchCheck');                       //财务管理-余额管理
        Route::get('balance_recharge', 'Branch\FinanceController@balance_recharge')->middleware('BranchCheck');     //财务管理-余额充值扣费
        Route::get('credit', 'Branch\FinanceController@credit')->middleware('BranchCheck');                         //财务管理-积分管理
        Route::get('credit_recharge', 'Branch\FinanceController@credit_recharge')->middleware('BranchCheck');       //财务管理-积分充值扣费
    });

    //支付设置
    Route::group(['prefix'=>'paysetting'],function(){
        Route::get('wechat_setting', 'Branch\PaysettingController@wechat_setting')->middleware('BranchCheck');   //支付设置-微信支付
        Route::get('zerone_setting', 'Branch\PaysettingController@zerone_setting')->middleware('BranchCheck');   //支付设置-零舍壹得
        Route::get('shengf_setting', 'Branch\PaysettingController@shengf_setting')->middleware('BranchCheck');   //支付设置-盛付通
        Route::get('kuaifu_setting', 'Branch\PaysettingController@kuaifu_setting')->middleware('BranchCheck');   //支付设置-快付通
    });




    //下属管理--权限角色组
    Route::group(['prefix'=>'role'],function(){
        Route::get('role_add', 'Branch\RoleController@role_add')->middleware('BranchCheck');   //添加权限角色
        Route::get('role_list', 'Branch\RoleController@role_list')->middleware('BranchCheck'); //权限角色列表
    });


    //下属管理--添加组
    Route::group(['prefix'=>'subordinate'],function(){
        Route::get('subordinate_add','Branch\SubordinateController@subordinate_add')->middleware('BranchCheck');    //添加下级人员
        Route::get('subordinate_list','Branch\SubordinateController@subordinate_list')->middleware('BranchCheck');  //下级人员列表
    });

    //异步提交数据组
    Route::group(['prefix'=>'ajax'],function(){
        Route::post('login_check','Branch\LoginController@login_check')->middleware('BranchCheckAjax');//提交登录数据
        Route::post('branch_select','Branch\DisplayController@branch_select')->middleware('BranchCheckAjax');//提交选择分店数据
        Route::post('profile_edit_check', 'Branch\AccountController@profile_edit_check')->middleware('BranchCheckAjax');//个人账号信息修改
        Route::post('safe_password_edit_check', 'Branch\AccountController@safe_password_edit_check')->middleware('BranchCheckAjax');//安全密码设置检测
        Route::post('password_edit_check', 'Branch\AccountController@password_edit_check')->middleware('BranchCheckAjax');          //密码检测
        Route::post('role_edit', 'Branch\RoleController@role_edit')->middleware('BranchCheckAjax');                     //角色编辑弹出
        Route::post('role_edit_check', 'Branch\RoleController@role_edit_check')->middleware('BranchCheckAjax');         //角色编辑检测
        Route::post('role_delete', 'Branch\RoleController@role_delete')->middleware('BranchCheckAjax');                 //角色删除弹出
        Route::post('role_delete_check', 'Branch\RoleController@role_delete_check')->middleware('BranchCheckAjax');     //角色删除检测
        Route::post('role_add_check', 'Branch\RoleController@role_add_check')->middleware('BranchCheckAjax');          //下级人员管理权限角色添加
        Route::post('quick_rule', 'Branch\SubordinateController@quick_rule')->middleware('BranchCheckAjax');                        //下属添加_用户权限页面

        Route::post('subordinate_add_check', 'Branch\SubordinateController@subordinate_add_check')->middleware('BranchCheckAjax');  //下属添加检测
        Route::post('subordinate_edit', 'Branch\SubordinateController@subordinate_edit')->middleware('BranchCheckAjax');            //下属信息编辑页面
        Route::post('subordinate_edit_check', 'Branch\SubordinateController@subordinate_edit_check')->middleware('BranchCheckAjax');//下属信息编辑检测
        Route::post('subordinate_lock', 'Branch\SubordinateController@subordinate_lock')->middleware('BranchCheckAjax');            //下属冻结检测
        Route::post('subordinate_delete', 'Branch\SubordinateController@subordinate_delete')->middleware('BranchCheckAjax');        //下属删除检测
        Route::post('subordinate_authorize', 'Branch\SubordinateController@subordinate_authorize')->middleware('BranchCheckAjax');  //下属快速授权页面
        Route::post('subordinate_authorize_check', 'Branch\SubordinateController@subordinate_authorize_check')->middleware('BranchCheckAjax');//下属快速授权检测
        Route::post('subordinate_lock', 'Branch\SubordinateController@subordinate_lock')->middleware('BranchCheckAjax');            //下属冻结页面
        Route::post('subordinate_lock_check', 'Branch\SubordinateController@subordinate_lock_check')->middleware('BranchCheckAjax');//下属冻结检测
        Route::post('selected_rule', 'Branch\SubordinateController@selected_rule')->middleware('BranchCheckAjax');                  //下属授权检测
    });
});
/**********************餐饮分店系统*********************/
