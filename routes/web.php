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
        Route::post('menu_edit_displayorder','Tooling\ProgramController@menu_edit_displayorder')->middleware('ToolingCheckAjax');//获取编辑菜单数据并提交

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

    //登录页面组
    Route::group(['prefix'=>'login'],function(){
        Route::get('/', 'Zerone\LoginController@display')->middleware('ZeroneCheck');//登录页面路由
        Route::get('captcha/{tmp}', 'Zerone\LoginController@captcha');               //验证码路由
    });

    Route::get('/', 'Zerone\DashboardController@display')->middleware('ZeroneCheck');//系统首页
    Route::get('quit','Zerone\DashboardController@quit');                            //退出系统

    //系统管理分组
    Route::group(['prefix'=>'dashboard'],function(){
        Route::get('warzone','Zerone\DashboardController@warzone')->middleware('ZeroneCheck');            //战区管理展示
        Route::get('structure','Zerone\DashboardController@structure')->middleware('ZeroneCheck');        //人员结构
        Route::get('operation_log','Zerone\DashboardController@operation_log')->middleware('ZeroneCheck');//所有操作记录
        Route::get('login_log','Zerone\DashboardController@login_log')->middleware('ZeroneCheck');        //所有登录记录
    });

    //个人中心组
    Route::group(['prefix'=>'personal'],function(){
        Route::get('/','Zerone\PersonalController@display')->middleware('ZeroneCheck');                   //个人资料
        Route::get('password_edit','Zerone\PersonalController@password_edit')->middleware('ZeroneCheck'); //登录密码修改
        Route::get('safe_password','Zerone\PersonalController@safe_password')->middleware('ZeroneCheck'); //安全密码设置
        Route::get('operation_log','Zerone\PersonalController@operation_log')->middleware('ZeroneCheck'); //我的操作日志
        Route::get('login_log','Zerone\PersonalController@login_log')->middleware('ZeroneCheck');         //我的登录日志
    });

    //权限角色组
    Route::group(['prefix'=>'role'],function(){
        Route::get('role_add','Zerone\RoleController@role_add')->middleware('ZeroneCheck');               //添加权限角色
        Route::get('role_list','Zerone\RoleController@role_list')->middleware('ZeroneCheck');             //权限角色列表
    });

    //下级人员权限组
    Route::group(['prefix'=>'subordinate'],function(){
        Route::get('subordinate_add','Zerone\SubordinateController@subordinate_add')->middleware('ZeroneCheck');            //添加下级人员
        Route::get('subordinate_list','Zerone\SubordinateController@subordinate_list')->middleware('ZeroneCheck');          //下级人员列表
        Route::get('subordinate_structure','Zerone\SubordinateController@subordinate_structure')->middleware('ZeroneCheck');//下级人员结构
    });

    //服务商管理
    Route::group(['prefix'=>'agent'],function(){
        Route::get('agent_examinelist','Zerone\AgentController@agent_examinelist')->middleware('ZeroneCheck');//服务商审核列表
        Route::get('agent_add','Zerone\AgentController@agent_add')->middleware('ZeroneCheck');                //添加服务商
        Route::get('agent_list','Zerone\AgentController@agent_list')->middleware('ZeroneCheck');              //服务商列表
        Route::get('agent_structure','Zerone\AgentController@agent_structure')->middleware('ZeroneCheck');    //服务商人员架构
        Route::get('agent_program','Zerone\AgentController@agent_program')->middleware('ZeroneCheck');        //服务商程序管理
        Route::get('agent_fansmanage','Zerone\AgentController@agent_fansmanage')->middleware('ZeroneCheck');  //服务商商户划拨
    });
    //商户管理
    Route::group(['prefix'=>'fansmanage'],function(){
        Route::get('fansmanage_add','Zerone\FansmanageController@fansmanage_add')->middleware('ZeroneCheck');                //添加商户
        Route::get('fansmanage_examinelist','Zerone\FansmanageController@fansmanage_examinelist')->middleware('ZeroneCheck');//商户审核列表
        Route::get('fansmanage_list','Zerone\FansmanageController@fansmanage_list')->middleware('ZeroneCheck');              //商户列表
        Route::get('fansmanage_structure','Zerone\FansmanageController@fansmanage_structure')->middleware('ZeroneCheck');    //商户店铺架构
        Route::get('fansmanage_program','Zerone\FansmanageController@fansmanage_program')->middleware('ZeroneCheck');        //商户程序管理
        Route::get('fansmanage_store','Zerone\FansmanageController@fansmanage_store')->middleware('ZeroneCheck');            //商户划拨管理
    });

    //异步提交数据组
    Route::group(['prefix'=>'ajax'],function(){
        Route::post('login_check','Zerone\LoginController@login_check')->middleware('ZeroneCheckAjax');//提交登录数据

        //系统管理
        Route::post('warzone_add','Zerone\DashboardController@warzone_add')->middleware('ZeroneCheckAjax');//战区管理编辑战区
        Route::post('warzone_add_check','Zerone\DashboardController@warzone_add_check')->middleware('ZeroneCheckAjax');//战区管理编辑战区
        Route::post('warzone_delete','Zerone\DashboardController@warzone_delete')->middleware('ZeroneCheckAjax');//战区管理去确认删除战区
        Route::post('warzone_delete_confirm','Zerone\DashboardController@warzone_delete_confirm')->middleware('ZeroneCheckAjax');//战区管理删除战区弹出框
        Route::post('warzone_edit','Zerone\DashboardController@warzone_edit')->middleware('ZeroneCheckAjax');//战区管理编辑战区
        Route::post('warzone_edit_check','Zerone\DashboardController@warzone_edit_check')->middleware('ZeroneCheckAjax');//战区管理编辑战区

        //个人中心
        Route::post('password_edit_check','Zerone\PersonalController@password_edit_check')->middleware('ZeroneCheckAjax');//个人中心修改密码
        Route::post('safe_password_edit_check','Zerone\PersonalController@safe_password_edit_check')->middleware('ZeroneCheckAjax');//个人中心修改密码
        Route::post('personal_edit_check','Zerone\PersonalController@personal_edit_check')->middleware('ZeroneCheckAjax');//个人中心修改个人信息


        //下级管理
        Route::post('role_add_check','Zerone\RoleController@role_add_check')->middleware('ZeroneCheckAjax');//提交添加权限角色数据
        Route::post('role_edit','Zerone\RoleController@role_edit')->middleware('ZeroneCheckAjax');//编辑权限角色弹出框
        Route::post('role_edit_check','Zerone\RoleController@role_edit_check')->middleware('ZeroneCheckAjax');//提交编辑权限角色数据
        Route::post('role_delete_comfirm','Zerone\RoleController@role_delete_comfirm');//删除权限角色弹出安全密码框
        Route::post('role_delete','Zerone\RoleController@role_delete')->middleware('ZeroneCheckAjax');//删除权限角色弹出安全密码框

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



        //服务商管理
        Route::post('agent_examine','Zerone\AgentController@agent_examine')->middleware('ZeroneCheckAjax');//服务商审核页面显示
        Route::post('agent_examine_check','Zerone\AgentController@agent_examine_check')->middleware('ZeroneCheckAjax');//服务商审核数据提交
        Route::post('agent_add_check','Zerone\AgentController@agent_add_check')->middleware('ZeroneCheckAjax');//提交编辑参数设置
        Route::post('agent_list_edit','Zerone\AgentController@agent_list_edit')->middleware('ZeroneCheckAjax');//服务商编辑显示页面
        Route::post('agent_list_edit_check','Zerone\AgentController@agent_list_edit_check')->middleware('ZeroneCheckAjax');//服务商编辑数据提交
        Route::post('agent_list_lock','Zerone\AgentController@agent_list_lock')->middleware('ZeroneCheckAjax');//服务商冻结显示页面
        Route::post('agent_list_lock_check','Zerone\AgentController@agent_list_lock_check')->middleware('ZeroneCheckAjax');//服务商冻结提交功能
        Route::post('agent_assets','Zerone\AgentController@agent_assets')->middleware('ZeroneCheckAjax');//服务商程序管理划入划出显示页面
        Route::post('agent_assets_check','Zerone\AgentController@agent_assets_check')->middleware('ZeroneCheckAjax');//服务商程序管理划入数据提交
        Route::post('agent_fansmanage_add','Zerone\AgentController@agent_fansmanage_add')->middleware('ZeroneCheckAjax');//商户划拨管理-商户划入归属
        Route::post('agent_fansmanage_add_check','Zerone\AgentController@agent_fansmanage_add_check')->middleware('ZeroneCheckAjax');//商户划拨管理-商户划入归属功能提交
        Route::post('agent_fansmanage_draw','Zerone\AgentController@agent_fansmanage_draw')->middleware('ZeroneCheckAjax');//商户划拨管理-商户划出归属
        Route::post('agent_fansmanage_draw_check','Zerone\AgentController@agent_fansmanage_draw_check')->middleware('ZeroneCheckAjax');//商户划拨管理-商户划出归属功能提交


        //商户管理
        Route::post('fansmanage_examine','Zerone\FansmanageController@fansmanage_examine')->middleware('ZeroneCheckAjax');//商户审核页面显示
        Route::post('fansmanage_examine_check','Zerone\FansmanageController@fansmanage_examine_check')->middleware('ZeroneCheckAjax');//商户审核提交数据
        Route::post('fansmanage_add_check','Zerone\FansmanageController@fansmanage_add_check')->middleware('ZeroneCheckAjax');//商户申请提交编辑参数设置
        Route::post('fansmanage_list_edit','Zerone\FansmanageController@fansmanage_list_edit')->middleware('ZeroneCheckAjax');//商户编辑页面显示
        Route::post('fansmanage_list_edit_check','Zerone\FansmanageController@fansmanage_list_edit_check')->middleware('ZeroneCheckAjax');//商户编辑数据提交
        Route::post('fansmanage_list_lock','Zerone\FansmanageController@fansmanage_list_lock')->middleware('ZeroneCheckAjax');//商户冻结页面显示
        Route::post('fansmanage_list_lock_check','Zerone\FansmanageController@fansmanage_list_lock_check')->middleware('ZeroneCheckAjax');//商户冻结数据提交
        Route::post('fansmanage_assets','Zerone\FansmanageController@fansmanage_assets')->middleware('ZeroneCheckAjax');//商户程序管理划入划出显示页面
        Route::post('fansmanage_assets_check','Zerone\FansmanageController@fansmanage_assets_check')->middleware('ZeroneCheckAjax');//商户程序管理划入数据提交
        Route::post('fansmanage_store_add','Zerone\FansmanageController@fansmanage_store_add')->middleware('ZeroneCheckAjax');//商户店铺管理划入页面显示
        Route::post('fansmanage_store_add_check','Zerone\FansmanageController@fansmanage_store_add_check')->middleware('ZeroneCheckAjax');//商户店铺管理划入数据提交
        Route::post('fansmanage_store_draw','Zerone\FansmanageController@fansmanage_store_draw')->middleware('ZeroneCheckAjax');//商户店铺管理划出页面显示
        Route::post('fansmanage_store_draw_check','Zerone\FansmanageController@fansmanage_store_draw_check')->middleware('ZeroneCheckAjax');//商户店铺管理划出数据提交

    });
});
/********************零壹管理系统*************************/


/**********************服务商管理系统*********************/
Route::group(['prefix'=>'agent'],function(){

    //登录页面组
    Route::group(['prefix'=>'login'],function(){
        Route::get('/', 'Agent\LoginController@display')->middleware('AgentCheck');//登录页面路由
        Route::get('captcha/{tmp}', 'Agent\LoginController@captcha');//验证码路由
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



/**********************总店系统*********************/
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
        Route::post('login_check','Catering\LoginController@login_check')->middleware('CateringCheck');             //提交登录数据

        //账号中心
        Route::post('profile_check','Catering\AccountController@profile_check')->middleware('CateringCheck');       //提交登录数据
        Route::post('safe_password_check','Catering\AccountController@safe_password_check')->middleware('CateringCheck');//安全密码数据提交
        Route::post('password_check','Catering\AccountController@password_check')->middleware('CateringCheck');     //安全密码数据提交

        //权限角色
        Route::post('role_add_check','Catering\RoleController@role_add_check')->middleware('CateringCheck');        //提交添加权限角色数据
        Route::post('role_edit','Catering\RoleController@role_edit')->middleware('CateringCheck');                  //编辑权限角色弹出框
        Route::post('role_edit_check','Catering\RoleController@role_edit_check')->middleware('CateringCheck');      //编辑权限角色弹出框
        Route::post('role_delete','Catering\RoleController@role_delete')->middleware('CateringCheck');              //删除权限角色弹出安全密码框
        Route::post('role_delete_check','Catering\RoleController@role_delete_check')->middleware('CateringCheck');  //删除权限角色弹出安全密码框

        //下属管理--添加组
        Route::post('subordinate_add_check','Catering\SubordinateController@subordinate_add_check')->middleware('CateringCheck');//添加下级人员数据提交
        Route::post('subordinate_edit','Catering\SubordinateController@subordinate_edit')->middleware('CateringCheck');//下级人员列表编辑用户弹出框
        Route::post('subordinate_edit_check','Catering\SubordinateController@subordinate_edit_check')->middleware('CateringCheck');//下级人员列表编辑功能提交
        Route::post('subordinate_authorize','Catering\SubordinateController@subordinate_authorize')->middleware('CateringCheck');//下级人员列表用户授权显示页面
        Route::post('subordinate_authorize_check','Catering\SubordinateController@subordinate_authorize_check')->middleware('CateringCheck');//下级人员列表用户授权功能提交页面
        Route::post('subordinate_delete','Catering\SubordinateController@subordinate_delete')->middleware('CateringCheck');//下级人员列表删除用户显示页面
        Route::post('subordinate_lock','Catering\SubordinateController@subordinate_lock')->middleware('CateringCheck');//冻结下级人员显示页面
        Route::post('subordinate_lock_check','Catering\SubordinateController@subordinate_lock_check')->middleware('CateringCheck');//冻结下级人员功能提交

        Route::post('quick_rule','Catering\SubordinateController@quick_rule')->middleware('CateringCheck');//添加下级人员快速授权
        Route::post('selected_rule','Catering\SubordinateController@selected_rule')->middleware('CateringCheck');//下级人员已经选中的权限出框

        //用户管理
        Route::post('label_add','Catering\UserController@label_add')->middleware('CateringCheck');                  //添加会员标签ajax显示页面
        Route::post('label_add_check','Catering\UserController@label_add_check')->middleware('CateringCheck');      //添加会员标签功能提交
        Route::post('label_edit','Catering\UserController@label_edit')->middleware('CateringCheck');                //编辑会员标签功能提交
        Route::post('label_edit_check','Catering\UserController@label_edit_check')->middleware('CateringCheck');    //编辑会员标签功能提交
        Route::post('label_delete','Catering\UserController@label_delete')->middleware('CateringCheck');            //删除会员标签功能提交
        Route::post('label_delete_check','Catering\UserController@label_delete_check')->middleware('CateringCheck');//删除会员标签功能提交

        Route::post('store_label_add_check','Catering\UserController@store_label_add_check')->middleware('CateringCheck');   //粉丝会员标签功能提交
        Route::post('user_list_edit','Catering\UserController@user_list_edit')->middleware('CateringCheck');                 //列表编辑ajax显示
        Route::post('user_list_edit_check','Catering\UserController@user_list_edit_check')->middleware('CateringCheck');     //列表编辑功能提交
        Route::post('user_list_lock','Catering\UserController@user_list_lock')->middleware('CateringCheck');                 //列表冻结ajax显示
        Route::post('user_list_lock_check','Catering\UserController@user_list_lock_check')->middleware('CateringCheck');     //列表冻结功能提交
        Route::post('user_list_wallet','Catering\UserController@user_list_wallet')->middleware('CateringCheck');             //列表粉丝钱包ajax显示

        //总店管理
        Route::post('branch_create_check','Catering\StoreController@branch_create_check')->middleware('CateringCheck');//总分店添加功能提交


        //营销管理
        Route::post('member_add_check','Catering\CardController@member_add_check')->middleware('CateringCheck');       //添加会员卡功能提交



    });
});
/**********************总店系统*********************/



/**********************粉丝管理系统*********************/
Route::group(['prefix'=>'fansmanage'],function(){

    //登录页面组
    Route::group(['prefix'=>'login'],function(){
        Route::get('/', 'Catering\LoginController@display')->middleware('FansmanageCheck');                               //登录页面路由
        Route::get('captcha/{tmp}', 'Catering\LoginController@captcha');                                                //验证码路由
    });

    Route::get('/', 'Catering\ShopController@display')->middleware('FansmanageCheck');                                    //系统首页
    Route::get('switch_status', 'Catering\ShopController@switch_status')->middleware('FansmanageCheck');                  //超级管理员切换服务商
    Route::get('quit', 'Catering\ShopController@quit');                                                                 //退出系统
    Route::post('select_shop','Catering\ShopController@select_shop')->middleware('FansmanageCheck');                      //超级管理员选择登入的服务商


    //账号中心
    Route::group(['prefix'=>'account'],function(){
        Route::get('profile', 'Catering\AccountController@profile')->middleware('FansmanageCheck');                       //账号信息
        Route::get('password', 'Catering\AccountController@password')->middleware('FansmanageCheck');                     //登入密码修改
        Route::get('safe_password', 'Catering\AccountController@safe_password')->middleware('FansmanageCheck');           //安全密码设置
        Route::get('message_setting', 'Catering\AccountController@message_setting')->middleware('FansmanageCheck');       //消息推送设置
        Route::get('operation_log', 'Catering\AccountController@operation_log')->middleware('FansmanageCheck');           //操作日记
        Route::get('login_log', 'Catering\AccountController@login_log')->middleware('FansmanageCheck');                   //登入日记
    });

    //公众号管理
    Route::group(['prefix'=>'subscription'],function(){
        Route::get('setting', 'Catering\SubscriptionController@setting')->middleware('FansmanageCheck');                              //公众号设置
        Route::get('material_image', 'Catering\SubscriptionController@material_image')->middleware('FansmanageCheck');                //图片素材
        Route::get('material_writing', 'Catering\SubscriptionController@material_writing')->middleware('FansmanageCheck');            //图文素材
        Route::get('material_writing_one', 'Catering\SubscriptionController@material_writing_one')->middleware('FansmanageCheck');    //单条图文
        Route::get('material_writing_one_edit', 'Catering\SubscriptionController@material_writing_one_edit')->middleware('FansmanageCheck');  //单条图文编辑
        Route::get('material_writing_many', 'Catering\SubscriptionController@material_writing_many')->middleware('FansmanageCheck');  //多条图文
        Route::get('material_writing_many_edit', 'Catering\SubscriptionController@material_writing_many_edit')->middleware('FansmanageCheck');//多条图文编辑
    });

    //公众号管理--消息管理 && 菜单管理
    Route::group(['prefix'=>'news'],function(){
        Route::get('message', 'Catering\NewsController@message')->middleware('FansmanageCheck');                          //关键词自动回复
        Route::get('message_attention', 'Catering\NewsController@message_attention')->middleware('FansmanageCheck');      //关注后自动回复
        Route::get('message_default', 'Catering\NewsController@message_default')->middleware('FansmanageCheck');          //默认回复
        Route::get('message_mass', 'Catering\NewsController@message_mass')->middleware('FansmanageCheck');                //消息群发

    });

    //公众号管理--菜单管理
    Route::group(['prefix'=>'menu'],function(){
        Route::get('menu_customize', 'Catering\MenuController@menu_customize')->middleware('FansmanageCheck');            //自定义菜单
        Route::get('menu_different', 'Catering\MenuController@menu_different')->middleware('FansmanageCheck');            //个性化菜单

    });

    //用户管理
    Route::group(['prefix'=>'user'],function(){
        Route::get('user_tag', 'Catering\UserController@user_tag')->middleware('FansmanageCheck');                        //粉丝标签管理
        Route::get('user_list', 'Catering\UserController@user_list')->middleware('FansmanageCheck');                      //粉丝用户管理
        Route::get('user_timeline', 'Catering\UserController@user_timeline')->middleware('FansmanageCheck');              //粉丝用户足迹
    });

    //下属管理--权限角色组
    Route::group(['prefix'=>'role'],function(){
        Route::get('role_add','Catering\RoleController@role_add')->middleware('FansmanageCheck');                         //添加权限角色
        Route::get('role_list','Catering\RoleController@role_list')->middleware('FansmanageCheck');                       //权限角色列表
    });


    //下属管理--添加组
    Route::group(['prefix'=>'subordinate'],function(){
        Route::get('subordinate_add','Catering\SubordinateController@subordinate_add')->middleware('FansmanageCheck');    //添加下级人员
        Route::get('subordinate_list','Catering\SubordinateController@subordinate_list')->middleware('FansmanageCheck');  //下级人员列表
    });

    //财务管理
    Route::group(['prefix'=>'finance'],function(){
        Route::get('balance','Catering\FinanceController@balance')->middleware('FansmanageCheck');                        //余额管理
        Route::get('balance_recharge','Catering\FinanceController@balance_recharge')->middleware('FansmanageCheck');      //余额详情
        Route::get('credit','Catering\FinanceController@credit')->middleware('FansmanageCheck');                          //积分管理
        Route::get('credit_recharge','Catering\FinanceController@credit_recharge')->middleware('FansmanageCheck');        //充值扣费
        Route::get('commission','Catering\FinanceController@commission')->middleware('FansmanageCheck');                  //佣金管理
    });

    //支付设置
    Route::group(['prefix'=>'payment'],function(){
        Route::get('wechat_setting','Catering\PaymentController@wechat_setting')->middleware('FansmanageCheck');          //微信支付
        Route::get('zerone_setting','Catering\PaymentController@zerone_setting')->middleware('FansmanageCheck');          //零舍壹得
        Route::get('sheng_setting','Catering\PaymentController@sheng_setting')->middleware('FansmanageCheck');            //盛付通
        Route::get('kuai_setting','Catering\PaymentController@kuai_setting')->middleware('FansmanageCheck');              //快付通
    });

    //商品管理
    Route::group(['prefix'=>'goods'],function(){
        Route::get('goods_category','Catering\GoodsController@goods_category')->middleware('FansmanageCheck');            //商品分类查询
        Route::get('goods_list','Catering\GoodsController@goods_list')->middleware('FansmanageCheck');                    //商品查询
        Route::get('goods_detail','Catering\GoodsController@goods_detail')->middleware('FansmanageCheck');                //商品查看详情
    });

    //总分店管理
    Route::group(['prefix'=>'store'],function(){
        Route::get('branch_create','Catering\StoreController@branch_create')->middleware('FansmanageCheck');              //创建总分店
        Route::get('branch_list','Catering\StoreController@branch_list')->middleware('FansmanageCheck');                  //总分店管理
    });
    //营销管理
    Route::group(['prefix'=>'card'],function(){
        Route::get('card_add','Catering\CardController@card_add')->middleware('FansmanageCheck');                         //添加会员卡
        Route::get('card_list','Catering\CardController@card_list')->middleware('FansmanageCheck');                       //会员卡管理
        Route::get('card_goods','Catering\CardController@card_goods')->middleware('FansmanageCheck');                     //调整适用商品
    });

    //异步提交数据组
    Route::group(['prefix'=>'ajax'],function(){
        Route::post('login_check','Catering\LoginController@login_check')->middleware('FansmanageCheckAjax');             //提交登录数据
        //账号中心
        Route::post('profile_check','Catering\AccountController@profile_check')->middleware('FansmanageCheckAjax');       //提交登录数据
        Route::post('safe_password_check','Catering\AccountController@safe_password_check')->middleware('FansmanageCheckAjax');//安全密码数据提交
        Route::post('password_check','Catering\AccountController@password_check')->middleware('FansmanageCheckAjax');     //安全密码数据提交
        //权限角色
        Route::post('role_add_check','Catering\RoleController@role_add_check')->middleware('FansmanageCheckAjax');        //提交添加权限角色数据
        Route::post('role_edit','Catering\RoleController@role_edit')->middleware('FansmanageCheckAjax');                  //编辑权限角色弹出框
        Route::post('role_edit_check','Catering\RoleController@role_edit_check')->middleware('FansmanageCheckAjax');      //编辑权限角色弹出框
        Route::post('role_delete','Catering\RoleController@role_delete')->middleware('FansmanageCheckAjax');              //删除权限角色弹出安全密码框
        Route::post('role_delete_check','Catering\RoleController@role_delete_check')->middleware('FansmanageCheckAjax');  //删除权限角色弹出安全密码框
        //下属管理--添加组
        Route::post('subordinate_add_check','Catering\SubordinateController@subordinate_add_check')->middleware('FansmanageCheckAjax');//添加下级人员数据提交
        Route::post('subordinate_edit','Catering\SubordinateController@subordinate_edit')->middleware('FansmanageCheckAjax');//下级人员列表编辑用户弹出框
        Route::post('subordinate_edit_check','Catering\SubordinateController@subordinate_edit_check')->middleware('FansmanageCheckAjax');//下级人员列表编辑功能提交
        Route::post('subordinate_authorize','Catering\SubordinateController@subordinate_authorize')->middleware('FansmanageCheckAjax');//下级人员列表用户授权显示页面
        Route::post('subordinate_authorize_check','Catering\SubordinateController@subordinate_authorize_check')->middleware('FansmanageCheckAjax');//下级人员列表用户授权功能提交页面
        Route::post('subordinate_delete','Catering\SubordinateController@subordinate_delete')->middleware('FansmanageCheckAjax');//下级人员列表删除用户显示页面
        Route::post('subordinate_lock','Catering\SubordinateController@subordinate_lock')->middleware('FansmanageCheckAjax');//冻结下级人员显示页面
        Route::post('subordinate_lock_check','Catering\SubordinateController@subordinate_lock_check')->middleware('FansmanageCheckAjax');//冻结下级人员功能提交
        Route::post('quick_rule','Catering\SubordinateController@quick_rule')->middleware('FansmanageCheckAjax');//添加下级人员快速授权
        Route::post('selected_rule','Catering\SubordinateController@selected_rule')->middleware('FansmanageCheckAjax');//下级人员已经选中的权限出框
        //用户管理
        Route::post('label_add','Catering\UserController@label_add')->middleware('FansmanageCheckAjax');                  //添加会员标签ajax显示页面
        Route::post('label_add_check','Catering\UserController@label_add_check')->middleware('FansmanageCheckAjax');      //添加会员标签功能提交
        Route::post('label_edit','Catering\UserController@label_edit')->middleware('FansmanageCheckAjax');                //编辑会员标签功能提交
        Route::post('label_edit_check','Catering\UserController@label_edit_check')->middleware('FansmanageCheckAjax');    //编辑会员标签功能提交
        Route::post('label_delete','Catering\UserController@label_delete')->middleware('FansmanageCheckAjax');            //删除会员标签功能提交
        Route::post('label_delete_check','Catering\UserController@label_delete_check')->middleware('FansmanageCheckAjax');//删除会员标签功能提交
        Route::post('store_label_add_check','Catering\UserController@store_label_add_check')->middleware('FansmanageCheckAjax');   //粉丝会员标签功能提交
        Route::post('user_list_edit','Catering\UserController@user_list_edit')->middleware('FansmanageCheckAjax');                 //列表编辑ajax显示
        Route::post('user_list_edit_check','Catering\UserController@user_list_edit_check')->middleware('FansmanageCheckAjax');     //列表编辑功能提交
        Route::post('user_list_lock','Catering\UserController@user_list_lock')->middleware('FansmanageCheckAjax');                 //列表冻结ajax显示
        Route::post('user_list_lock_check','Catering\UserController@user_list_lock_check')->middleware('FansmanageCheckAjax');     //列表冻结功能提交
        Route::post('user_list_wallet','Catering\UserController@user_list_wallet')->middleware('FansmanageCheckAjax');             //列表粉丝钱包ajax显示
        //总店管理
        Route::post('branch_create_check','Catering\StoreController@branch_create_check')->middleware('FansmanageCheckAjax');//总分店添加功能提交
        //营销管理
        Route::post('member_add_check','Catering\CardController@member_add_check')->middleware('FansmanageCheckAjax');       //添加会员卡功能提交
    });
});
/**********************粉丝管理系统*********************/

/**********************零售版店铺管理系统*********************/
Route::group(['prefix'=>'retail'],function(){
    //登录页面组
    Route::group(['prefix'=>'login'],function(){
        Route::get('/', 'Retail\LoginController@display')->middleware('RetailCheck');//登录页面路由
        Route::get('captcha/{tmp}', 'Retail\LoginController@captcha');//验证码路由
    });
    Route::get('/', 'Retail\DisplayController@display')->middleware('RetailCheck');//分店首页
    Route::get('quit', 'Retail\LoginController@quit');                                                 //退出系统
    Route::get('retail_list', 'Retail\DisplayController@retail_list')->middleware('RetailCheck');      //分店列表
    Route::get('retail_switch', 'Retail\DisplayController@retail_switch')->middleware('RetailCheck'); //超级管理员退出当前店铺

    //账户中心
    Route::group(['prefix'=>'account'],function(){
        Route::get('profile', 'Retail\AccountController@profile')->middleware('RetailCheck'); //账号中心-账户信息
        Route::get('safe_password', 'Retail\AccountController@safe_password')->middleware('RetailCheck');//安全密码
        Route::get('message_setting', 'Retail\AccountController@message_setting')->middleware('RetailCheck');//消息接收设置
        Route::get('password', 'Retail\AccountController@password')->middleware('RetailCheck');          //登录密码页面
    });


    //栏目管理
    Route::group(['prefix'=>'category'],function(){
        Route::get('category_add', 'Retail\CategoryController@category_add')->middleware('RetailCheck');   //商品管理-添加商品分类
        Route::get('category_list', 'Retail\CategoryController@category_list')->middleware('RetailCheck'); //商品管理-商品分类列表
    });

    //商品管理
    Route::group(['prefix'=>'goods'],function(){
        Route::get('goods_add', 'Retail\GoodsController@goods_add')->middleware('RetailCheck');         //商品管理-添加商品
        Route::get('goods_edit', 'Retail\GoodsController@goods_edit')->middleware('RetailCheck');       //商品管理-编辑商品
        Route::get('goods_list', 'Retail\GoodsController@goods_list')->middleware('RetailCheck');       //商品管理-商品列表
    });

    //订单管理
    Route::group(['prefix'=>'order'],function(){
        Route::get('order_spot', 'Retail\OrderController@order_spot')->middleware('RetailCheck');                       //订单管理-现场订单
        Route::get('order_spot_detail', 'Retail\OrderController@order_spot_detail')->middleware('RetailCheck');         //订单管理-现场订单详情
        Route::get('order_takeout', 'Retail\OrderController@order_takeout')->middleware('RetailCheck');                 //订单管理-外卖订单
        Route::get('order_takeout_detail', 'Retail\OrderController@order_takeout_detail')->middleware('RetailCheck');   //订单管理-外卖订单详情
        Route::get('order_appointment', 'Retail\OrderController@order_appointment')->middleware('RetailCheck');         //预约管理
    });

    //用户管理
    Route::group(['prefix'=>'user'],function(){
        Route::get('user_list', 'Retail\UserController@user_list')->middleware('RetailCheck');          //用户管理-粉丝用户管理
    });

    //支付设置
    Route::group(['prefix'=>'paysetting'],function(){
        Route::get('wechat_setting', 'Retail\PaysettingController@wechat_setting')->middleware('RetailCheck');   //支付设置-微信支付
    });


    //下属管理--添加组
    Route::group(['prefix'=>'subordinate'],function(){
        Route::get('subordinate_add','Retail\SubordinateController@subordinate_add')->middleware('RetailCheck');    //添加下级人员
        Route::get('subordinate_list','Retail\SubordinateController@subordinate_list')->middleware('RetailCheck');  //下级人员列表
    });

    //异步提交数据组
    Route::group(['prefix'=>'ajax'],function(){
        Route::post('login_check','Retail\LoginController@login_check')->middleware('RetailCheckAjax');//提交登录数据
        Route::post('retail_select','Retail\DisplayController@retail_select')->middleware('RetailCheckAjax');//提交选择分店数据
        Route::post('store_edit_check', 'Retail\DisplayController@store_edit_check')->middleware('RetailCheckAjax');;    //分店店铺信息编辑弹窗
        Route::post('profile_edit_check', 'Retail\AccountController@profile_edit_check')->middleware('RetailCheckAjax');//个人账号信息修改
        Route::post('safe_password_edit_check', 'Retail\AccountController@safe_password_edit_check')->middleware('RetailCheckAjax');//安全密码设置检测
        Route::post('password_edit_check', 'Retail\AccountController@password_edit_check')->middleware('RetailCheckAjax');          //密码检测


        Route::post('subordinate_add_check', 'Retail\SubordinateController@subordinate_add_check')->middleware('RetailCheckAjax');  //下属添加检测
        Route::post('subordinate_edit', 'Retail\SubordinateController@subordinate_edit')->middleware('RetailCheckAjax');            //下属信息编辑页面
        Route::post('subordinate_edit_check', 'Retail\SubordinateController@subordinate_edit_check')->middleware('RetailCheckAjax');//下属信息编辑检测
        Route::post('subordinate_lock', 'Retail\SubordinateController@subordinate_lock')->middleware('RetailCheckAjax');            //下属冻结检测
        Route::post('subordinate_delete', 'Retail\SubordinateController@subordinate_delete')->middleware('RetailCheckAjax');        //下属删除检测
        Route::post('subordinate_lock', 'Retail\SubordinateController@subordinate_lock')->middleware('RetailCheckAjax');            //下属冻结页面
        Route::post('subordinate_lock_check', 'Retail\SubordinateController@subordinate_lock_check')->middleware('RetailCheckAjax');//下属冻结检测

        Route::post('category_add_check', 'Retail\CategoryController@category_add_check')->middleware('RetailCheckAjax');          //栏目添加检测
        Route::post('category_delete', 'Retail\CategoryController@category_delete')->middleware('RetailCheckAjax');          //栏目添加检测
        Route::post('category_delete_check', 'Retail\CategoryController@category_delete_check')->middleware('RetailCheckAjax');          //栏目添加检测
        Route::post('category_edit', 'Retail\CategoryController@category_edit')->middleware('RetailCheckAjax');                    //栏目编辑页面
        Route::post('category_edit_check', 'Retail\CategoryController@category_edit_check')->middleware('RetailCheckAjax');        //栏目编辑检测
        Route::post('goods_add_check', 'Retail\GoodsController@goods_add_check')->middleware('RetailCheckAjax');                   //商品添加检测
        Route::post('goods_delete', 'Retail\GoodsController@goods_delete')->middleware('RetailCheckAjax');                         //商品删除弹窗
        Route::post('goods_delete_check', 'Retail\GoodsController@goods_delete_check')->middleware('RetailCheckAjax');             //商品删除检测
        Route::post('goods_edit_check', 'Retail\GoodsController@goods_edit_check')->middleware('RetailCheckAjax');                 //商品编辑检测
        Route::post('order_status', 'Retail\OrderController@order_status')->middleware('RetailCheckAjax');                         //修改订单状态弹窗
        Route::post('order_status_check', 'Retail\OrderController@order_status_check')->middleware('RetailCheckAjax');             //修改订单状态检测
        Route::any('goods_thumb', 'Retail\GoodsController@goods_thumb')->middleware('RetailCheckAjax');                           //商品规格异步加载页面
        Route::post('upload_thumb_check', 'Retail\GoodsController@upload_thumb_check')->middleware('RetailCheckAjax');             //上传文件检测
    });
});
/**********************零售版店铺管理系统*********************/

/*********************接口路由*************************/
Route::group(['prefix'=>'api'],function() {

    //微信通用路由组
    Route::group(['prefix' => 'wechat'], function () {
        Route::any('response/{appid}', 'Api\WechatController@response');//开放平台控制公众平台回复函数
        Route::any('open', 'Api\WechatController@open');//接受公众号收授权推送消息
        Route::any('auth', 'Api\WechatController@auth');//公众号授权链接页面
        Route::any('redirect', 'Api\WechatController@redirect');//公众号授权回调链接
        Route::any('web_redirect', 'Api\WechatController@web_redirect');//网页授权回调路由
        Route::any('open_web_redirect','Api\WechatController@open_web_redirect');
        Route::any('pull_authorizer_data', 'Api\WechatController@pull_authorizer_data');//获取微信平台的授权信息
        Route::any('test', 'Api\WechatController@test');//测试函数
    });

    //餐饮版店铺授权页面
    Route::group(['prefix' => 'catering'] , function(){
        Route::any('store_auth', 'Api\WechatController@store_auth')->middleware('CateringCheck');//开放平台控制公众平台回复函数
        Route::any('material_image', 'Api\WechatController@material_image')->middleware('CateringCheck');//图片素材
        Route::any('material_article','Api\WechatController@material_article')->middleware('CateringCheck');//图文素材列表
        Route::any('material_article_add','Api\WechatController@material_article_add')->middleware('CateringCheck');//图文素材列表
        Route::any('material_articles_add','Api\WechatController@material_articles_add')->middleware('CateringCheck');//添加多条图文列表
        Route::any('material_article_edit','Api\WechatController@material_article_edit')->middleware('CateringCheck');//添加多条图文列表
        Route::any('material_articles_edit','Api\WechatController@material_articles_edit')->middleware('CateringCheck');//添加多条图文列表
        Route::any('defined_menu','Api\WechatController@defined_menu')->middleware('CateringCheck');//自定义菜单管理页面
        Route::any('auto_reply','Api\WechatController@auto_reply')->middleware('CateringCheck');//关键词自动回复
        Route::any('subscribe_reply','Api\WechatController@subscribe_reply')->middleware('CateringCheck');//关注事件自动回复
        Route::any('default_reply','Api\WechatController@default_reply')->middleware('CateringCheck');//默认回复
    });

    //微信接口中页面使用Ajax的部分
    Route::group(['prefix' => 'ajax'] , function(){
        Route::any('meterial_image_upload', 'Api\WechatController@meterial_image_upload')->middleware('CateringCheckAjax');//上传图片素材
        Route::any('meterial_image_upload_check', 'Api\WechatController@meterial_image_upload_check')->middleware('CateringCheckAjax');//上传图片素材
        Route::any('meterial_image_upload', 'Api\WechatController@meterial_image_upload')->middleware('CateringCheckAjax');//上传图片素材
        Route::any('meterial_image_upload_check', 'Api\WechatController@meterial_image_upload_check')->middleware('CateringCheckAjax');//上传图片素材
        Route::any('material_image_delete_comfirm', 'Api\WechatController@material_image_delete_comfirm')->middleware('CateringCheckAjax');//删除图片素材弹窗
        Route::any('material_image_delete_check', 'Api\WechatController@material_image_delete_check')->middleware('CateringCheckAjax');//检测删除图片素材数据
        Route::any('material_image_select', 'Api\WechatController@material_image_select')->middleware('CateringCheckAjax');//弹出图片选择框
        Route::any('material_article_add_check','Api\WechatController@material_article_add_check')->middleware('CateringCheckAjax');//添加单条图文检测
        Route::any('material_articles_add_check','Api\WechatController@material_articles_add_check')->middleware('CateringCheckAjax');//添加多条图文检测
        Route::any('material_article_delete_comfirm','Api\WechatController@material_article_delete_comfirm')->middleware('CateringCheckAjax');//添加单条图文检测
        Route::any('material_article_delete_check','Api\WechatController@material_article_delete_check')->middleware('CateringCheckAjax');//添加单条图文检测
        Route::any('material_article_edit_check','Api\WechatController@material_article_edit_check')->middleware('CateringCheckAjax');//添加单条图文检测
        Route::any('material_articles_edit_check','Api\WechatController@material_articles_edit_check')->middleware('CateringCheckAjax');//添加多条图文检测
        Route::any('defined_menu_add','Api\WechatController@defined_menu_add')->middleware('CateringCheckAjax');//添加自定义菜单板块
        Route::any('defined_menu_get','Api\WechatController@defined_menu_get')->middleware('CateringCheckAjax');//获取自定义菜单数据
        Route::any('auto_reply_add','Api\WechatController@auto_reply_add')->middleware('CateringCheckAjax');
        Route::any('auto_reply_add_check','Api\WechatController@auto_reply_add_check')->middleware('CateringCheckAjax');
        Route::any('auto_reply_edit_text','Api\WechatController@auto_reply_edit_text')->middleware('CateringCheckAjax');
        Route::any('auto_reply_edit_text_check','Api\WechatController@auto_reply_edit_text_check')->middleware('CateringCheckAjax');
        Route::any('auto_reply_edit_image','Api\WechatController@auto_reply_edit_image')->middleware('CateringCheckAjax');
        Route::any('auto_reply_edit_image_check','Api\WechatController@auto_reply_edit_image_check')->middleware('CateringCheckAjax');
        Route::any('auto_reply_edit_article','Api\WechatController@auto_reply_edit_article')->middleware('CateringCheckAjax');
        Route::any('auto_reply_edit_article_check','Api\WechatController@auto_reply_edit_article_check')->middleware('CateringCheckAjax');
        Route::any('auto_reply_edit','Api\WechatController@auto_reply_edit')->middleware('CateringCheckAjax');
        Route::any('auto_reply_edit_check','Api\WechatController@auto_reply_edit_check')->middleware('CateringCheckAjax');
        Route::any('auto_reply_delete_confirm','Api\WechatController@auto_reply_delete_confirm')->middleware('CateringCheckAjax');
        Route::any('auto_reply_delete_check','Api\WechatController@auto_reply_delete_check')->middleware('CateringCheckAjax');
        Route::any('subscribe_reply_text_edit','Api\WechatController@subscribe_reply_text_edit')->middleware('CateringCheckAjax');
        Route::any('subscribe_reply_text_edit_check','Api\WechatController@subscribe_reply_text_edit_check')->middleware('CateringCheckAjax');
        Route::any('subscribe_reply_image_edit','Api\WechatController@subscribe_reply_image_edit')->middleware('CateringCheckAjax');
        Route::any('subscribe_reply_image_edit_check','Api\WechatController@subscribe_reply_image_edit_check')->middleware('CateringCheckAjax');
        Route::any('subscribe_reply_article_edit','Api\WechatController@subscribe_reply_article_edit')->middleware('CateringCheckAjax');
        Route::any('subscribe_reply_article_edit_check','Api\WechatController@subscribe_reply_article_edit_check')->middleware('CateringCheckAjax');
        Route::any('default_reply_text_edit','Api\WechatController@default_reply_text_edit')->middleware('CateringCheckAjax');
        Route::any('default_reply_text_edit_check','Api\WechatController@default_reply_text_edit_check')->middleware('CateringCheckAjax');
        Route::any('default_reply_image_edit','Api\WechatController@default_reply_image_edit')->middleware('CateringCheckAjax');
        Route::any('default_reply_image_edit_check','Api\WechatController@default_reply_image_edit_check')->middleware('CateringCheckAjax');
        Route::any('default_reply_article_edit','Api\WechatController@default_reply_article_edit')->middleware('CateringCheckAjax');
        Route::any('default_reply_article_edit_check','Api\WechatController@default_reply_article_edit_check')->middleware('CateringCheckAjax');
    });
});
/*********************接口路由*************************/