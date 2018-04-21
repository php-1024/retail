<?php

/**
 * 店铺概况模块，包括：
 *   店铺首页，操作日志，登录日志
 */
namespace App\Http\Controllers\Fansmanage;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\LoginLog;
use App\Models\OperationLog;
use App\Models\Organization;
use App\Services\ZeroneRedis\ZeroneRedis;
use Illuminate\Http\Request;
use Session;

class ShopController extends Controller
{
    //首页
    public function display(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $organization_id = $admin_data['organization_id'];//服务商id
        dump($admin_data);
        if ($admin_data['is_super'] == 1) {
            $organization_name = $request->organization_name;
            $where = ['type' => '3'];
            $listOrg = Organization::getOrganizationAndAccount($organization_name, $where, 20, 'id', 'ASC'); //查询分店
            return view('Fansmanage/Shop/select_shop', ['listOrg' => $listOrg]);
        } else {
            $where = [['organization_id', $organization_id]];
            $account_id = Account::getPluck([['organization_id', $organization_id], ['parent_id', 1]], 'id')->first();//获取负责人id
            if ($account_id != $admin_data['id']) {//如果不是服务商负责人 只允许看自己的登入记录
                $where[] = ['account_id', $admin_data['id']];
            }
            $login_log_list = LoginLog::getList($where, 5, 'id');//登录记录
            $operation_log_list = OperationLog::getList($where, 5, 'id');//操作记录
            $acc_num = Account::where([['organization_id', $organization_id]])->count();//查询服务商人数
            $org_num = Organization::where([['parent_id', $organization_id]])->count();//查询服务商附属商务个数
            return view('Fansmanage/Shop/index', ['login_log_list' => $login_log_list, 'operation_log_list' => $operation_log_list, 'acc_num' => $acc_num, 'org_num' => $org_num, 'admin_data' => $admin_data, 'route_name' => $route_name, 'menu_data' => $menu_data, 'son_menu_data' => $son_menu_data]);
        }
    }

    //超级管理员选择服务商
    public function select_shop(Request $request)
    {
        $admin_this = $request->get('admin_data');              //中间件产生的管理员数据参数
//        $organization_id = $request->input('organization_id');  //中间件产生的管理员数据参数
        $account_id = $request->input('account_id');            //用户ID
//        $account_info = Account::getOneAccount([['organization_id',$organization_id],['parent_id','1']]);//根据账号查询
        $account_info = Account::getOneAccount([['id', $account_id]]);//根据账号查询
        if (!empty($account_info)) {
            //重新生成缓存的登录信息
            $admin_data = [
                'id' => $account_info->id,    //用户ID
                'account' => $account_info->account,//用户账号
                'organization_id' => $account_info->organization_id,//组织ID
                'is_super' => '2',//是否超级管理员
                'parent_id' => $account_info->parent_id,//上级ID
                'parent_tree' => $account_info->parent_tree,//上级树
                'deepth' => $account_info->deepth,//账号在组织中的深度
                'mobile' => $account_info->mobile,//绑定手机号
                'safe_password' => $admin_this['safe_password'],//安全密码-超级管理员
                'account_status' => $account_info->status,//用户状态
            ];
            Session::put('fansmanage_account_id', encrypt(1));//存储登录session_id为当前用户ID
            //构造用户缓存数据
            if (!empty($account_info->account_info->realname)) {
                $admin_data['realname'] = $account_info->account_info->realname;
            } else {
                $admin_data['realname'] = '未设置';
            }
            if (!empty($account_info->account_roles) && $account_info->account_roles->count() != 0) {
                foreach ($account_info->account_roles as $key => $val) {
                    $account_info->role = $val;
                }
                $admin_data['role_name'] = $account_info->role->role_name;
            } else {
                $admin_data['role_name'] = '角色未设置';
            }
            ZeroneRedis::create_fansmanage_account_cache(1, $admin_data);//生成账号数据的Redis缓存
            ZeroneRedis::create_fansmanage_menu_cache(1);//生成对应账号的系统菜单
            return response()->json(['data' => '操作成功', 'status' => '1']);

        } else {
            return response()->json(['data' => '操作失败', 'status' => '0']);
        }
    }

    //超级管理员选择店铺
    public function switch_status(Request $request)
    {
        $admin_this = $request->get('admin_data');              //中间件产生的管理员数据参数
//        $organization_id = $request->input('organization_id');  //中间件产生的管理员数据参数
        $account_id = $request->input('account_id');            //用户ID
//        $account_info = Account::getOneAccount([['organization_id',$organization_id],['parent_id','1']]);//根据账号查询
        $account_info = Account::getOneAccount([['id', $account_id]]);//根据账号查询
        if (!empty($account_info)) {
            //重新生成缓存的登录信息
            $admin_data = [
                'organization_id' => '',//组织ID
                'is_super' => '1',//是否超级管理员
            ];
            Session::put('fansmanage_account_id', encrypt(1));//存储登录session_id为当前用户ID
            ZeroneRedis::create_fansmanage_account_cache(1, $admin_data);//生成账号数据的Redis缓存
            ZeroneRedis::create_fansmanage_menu_cache(1);//生成对应账号的系统菜单
            return redirect('fansmanage');
        }
    }

    //我的操作记录
    public function operation_log(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        $account = $admin_data['account'];//通过登录页账号查询
        $time_st = $request->input('time_st');//查询时间开始
        $time_nd = $request->input('time_nd');//查询时间结束
        $time_st_format = $time_nd_format = 0;//实例化时间格式
        if (!empty($time_st) && !empty($time_nd)) {
            $time_st_format = strtotime($time_st . ' 00:00:00');//开始时间转时间戳
            $time_nd_format = strtotime($time_nd . ' 23:59:59');//结束时间转时间戳
        }
        $search_data = ['time_st' => $time_st, 'time_nd' => $time_nd];
        $list = OperationLog::getUnionPaginate($account, $time_st_format, $time_nd_format, 10, 'id');
        return view('Fansmanage/Shop/operation_log', ['list' => $list, 'search_data' => $search_data, 'admin_data' => $admin_data, 'menu_data' => $menu_data, 'son_menu_data' => $son_menu_data, 'route_name' => $route_name]);
    }

    //我的登入记录
    public function login_log(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $account = $admin_data['account'];//通过登录页账号查询
        $time_st = $request->input('time_st');//查询时间开始
        $time_nd = $request->input('time_nd');//查询时间结束
        $time_st_format = $time_nd_format = 0;//实例化时间格式
        if (!empty($time_st) && !empty($time_nd)) {
            $time_st_format = strtotime($time_st . ' 00:00:00');//开始时间转时间戳
            $time_nd_format = strtotime($time_nd . ' 23:59:59');//结束时间转时间戳
        }
        $search_data = ['time_st' => $time_st, 'time_nd' => $time_nd];
        $list = LoginLog::getUnionPaginate($account, $time_st_format, $time_nd_format, 15, 'id');
        return view('Fansmanage/Shop/login_log', ['list' => $list, 'search_data' => $search_data, 'admin_data' => $admin_data, 'menu_data' => $menu_data, 'son_menu_data' => $son_menu_data, 'route_name' => $route_name]);
    }

    //退出登录
    public function quit(Request $request)
    {
        Session::put('fansmanage_account_id', '');
        return redirect('fansmanage/login');
    }
}