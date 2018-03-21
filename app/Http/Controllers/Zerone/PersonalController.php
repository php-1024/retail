<?php
namespace App\Http\Controllers\Zerone;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\LoginLog;
use App\Models\OperationLog;
use App\Models\ProgramModuleNode;
use App\Models\Module;
use App\Models\AccountInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Session;

class PersonalController extends Controller{
    //个人中心——个人资料
    public function display(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $account_id = $admin_data['id'];//当前登录账号ID
        $user = Account::getOne([['id',$admin_data['id']]]);
        if($account_id == 1) {//如果是超级管理员
            $module_node_list = Module::getListProgram(1, [], 0, 'id');//获取当前系统的所有模块和节点
        }else{
            $account_node_list = ProgramModuleNode::getAccountModuleNodes(1,$admin_data['id']);//获取当前用户具有权限的节点
            $modules = [];
            $nodes = [];
            $module_node_list = [];
            //过滤重复选出的节点和模块
            foreach($account_node_list as $key=>$val){
                $modules[$val->module_id] = $val->module_name;
                $nodes[$val->module_id][$val->node_id] = $val->node_name;
            }
            //遍历，整理为合适的格式
            foreach($modules as $key=>$val){
                $module = ['id'=>$key,'module_name'=>$val];
                foreach($nodes[$key] as $k=>$v){
                    $module['program_nodes'][] = array('id'=>$k,'node_name'=>$v);
                }
                $module_node_list[] = $module;
                unset($module);
            }
        }
        dump($module_node_list);
        return view('Zerone/Personal/display',['user'=>$user,'admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name,'module_node_list'=>$module_node_list]);
    }

    //个人中心 - 修改个人资料
    public function personal_edit_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $realname = $request->input('realname');
        $mobile = $request->input('mobile');
        DB::beginTransaction();
        try {
            Account::editAccount([['id',$admin_data['id']]],['mobile'=>$mobile]);
            AccountInfo::editAccountInfo([['account_id',$admin_data['id']]],['realname'=>$realname]);
            OperationLog::addOperationLog('1',$admin_data['organization_id'],$admin_data['id'],$route_name,'修改了个人信息');//保存操作记录
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '修改个人信息失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '修改个人信息成功', 'status' => '1']);
    }

    //个人中心——登录密码修改
    public function password_edit(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        return view('Zerone/Personal/password_edit',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }

    //个人中心——登录密码修改
    public function password_edit_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $account = Account::getOne([['id',$admin_data['id']]]);
        $password = $request->input('password');
        $new_password = $request->input('new_password');
        $key = config("app.zerone_encrypt_key");//获取加密盐
        $encrypted = md5($password);//加密密码第一重
        $encryptPwd = md5("lingyikeji".$encrypted.$key);//加密密码第二重
        $new_encrypted = md5($new_password);//加密新密码第一重
        $new_encryptPwd = md5("lingyikeji".$new_encrypted.$key);//加密新码第二重
        if ($account['password'] == $encryptPwd){
            DB::beginTransaction();
            try {
                Account::editAccount([['id',$admin_data['id']]],['password' => $new_encryptPwd]);
                OperationLog::addOperationLog('1',$admin_data['organization_id'],$admin_data['id'],$route_name,'修改了登录密码');//保存操作记录
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();//事件回滚
                return response()->json(['data' => '修改登录密码失败，请检查', 'status' => '0']);
            }
            return response()->json(['data' => '登录密码修改成功！', 'status' => '1']);
        }else{
            return response()->json(['data' => '原密码不正确！', 'status' => '1']);
        }
    }

    //个人中心——安全密码设置
    public function safe_password(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        return view('Zerone/Personal/safe_password',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }
    //个人中心——安全密码修改(设置)
    public function safe_password_edit_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $is_editing = $request->input('is_editing');    //是否修改安全密码
        $old_safe_password = $request->input('old_safe_password');    //原安全密码
        $safe_password = $request->input('safe_password');  //新安全密码
        $key = config("app.zerone_safe_encrypt_key");//获取加密盐
        $encrypted = md5($safe_password);//加密安全密码第一重
        $encryptPwd = md5("lingyikeji".$encrypted.$key);//加密安全密码第二重
        $old_encrypted = md5($old_safe_password);//加密新安全密码第一重
        $old_encryptPwd = md5("lingyikeji".$old_encrypted.$key);//加密新安全密码第二重
        if ($is_editing == '-1'){
                DB::beginTransaction();
                try {
                    Account::editAccount([['id',$admin_data['id']]],['safe_password' => $encryptPwd]);
                    OperationLog::addOperationLog('1',$admin_data['organization_id'],$admin_data['id'],$route_name,'设置了安全密码');//保存操作记录
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();//事件回滚
                    return response()->json(['data' => '设置安全密码失败，请检查', 'status' => '0']);
                }
                $admin_data['safe_password'] = $encryptPwd;
                \ZeroneRedis::create_account_cache($admin_data['id'],$admin_data);//生成账号数据的Redis缓存
                return response()->json(['data' => '安全密码设置成功', 'status' => '1']);
        }else{//修改安全密码
            if ($admin_data['safe_password'] == $old_encryptPwd){
                DB::beginTransaction();
                try {
                    Account::editAccount([['id',$admin_data['id']]],['safe_password' => $encryptPwd]);
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();//事件回滚
                    return response()->json(['data' => '安全密码修改失败，请检查', 'status' => '0']);
                }
                $admin_data['safe_password'] = $encryptPwd;
                \ZeroneRedis::create_account_cache($admin_data['id'],$admin_data);//生成账号数据的Redis缓存
                return response()->json(['data' => '安全密码修改成功！', 'status' => '1']);
            }else{
                return response()->json(['data' => '原安全密码不正确！', 'status' => '0']);
            }
        }
    }
    //个人中心——我的操作日志
    public function operation_log(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $time_st = $request->input('time_st');//查询时间开始
        $time_nd = $request->input('time_nd');//查询时间结束
        $account = $request->input('account');//查询操作账户
        $time_st_format = $time_nd_format = 0;//实例化时间格式
        if(!empty($time_st) && !empty($time_nd)) {
            $time_st_format = strtotime($time_st . ' 00:00:00');//开始时间转时间戳
            $time_nd_format = strtotime($time_nd . ' 23:59:59');//结束时间转时间戳
        }
        //只查询自己相关的数据
        $where = [
            ['account_id',$admin_data['id']]
        ];
        $search_data = ['time_st'=>$time_st,'time_nd'=>$time_nd,'account'=>$account];
        $operation_log_list = OperationLog::getPaginate($where,$time_st_format,$time_nd_format,10,'id');//操作记录
        return view('Zerone/Personal/operation_log',['search_data'=>$search_data,'operation_log_list'=>$operation_log_list,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    //个人中心——我的登录日志
    public function login_log(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $time_st = $request->input('time_st');//查询时间开始
        $time_nd = $request->input('time_nd');//查询时间结束
        $account = $request->input('account');//查询操作账户
        $time_st_format = $time_nd_format = 0;//实例化时间格式
        if(!empty($time_st) && !empty($time_nd)) {
            $time_st_format = strtotime($time_st . ' 00:00:00');//开始时间转时间戳
            $time_nd_format = strtotime($time_nd . ' 23:59:59');//结束时间转时间戳
        }
        //只查询自己相关的数据
        $where = [
            ['account_id',$admin_data['id']]
        ];
        $search_data = ['time_st'=>$time_st,'time_nd'=>$time_nd,'account'=>$account];
        $login_log_list = LoginLog::getPaginate($where,$time_st_format,$time_nd_format,10,'id');//登录记录
        return view('Zerone/Personal/login_log',['search_data'=>$search_data,'login_log_list'=>$login_log_list,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

}
?>