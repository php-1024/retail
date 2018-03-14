<?php
/**
 *账户中心
 *
 **/
namespace App\Http\Controllers\CateringBranch;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountInfo;
use App\Models\LoginLog;
use App\Models\Module;
use App\Models\OperationLog;
use App\Models\ProgramModuleNode;
use App\Services\ZeroneRedis\ZeroneRedis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class AccountController extends Controller{

    //账号信息修改页面
    public function profile(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                     //获取当前的页面路由
        $user = Account::getOne(['id'=>$admin_data['id']]);
        $account_id = $admin_data['id'];//当前登录账号ID
        if($account_id == 1) {//如果是超级管理员
            $module_node_list = Module::getListProgram(5, [], 0, 'id');//获取当前系统的所有模块和节点
        }else{
            $account_node_list = ProgramModuleNode::getAccountModuleNodes(5,$admin_data['id']);//获取当前用户具有权限的节点
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
        return view('CateringBranch/Account/profile',['module_node_list'=>$module_node_list,'user'=>$user,'admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }

    //个人账号信息修改处理
    public function profile_edit_check(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $realname = $request->input('realname');    //真实姓名
        $mobile = $request->input('mobile');        //手机号码
        $id = AccountInfo::checkRowExists([['account_id',$admin_data['id']]]);//查询是否存在该数据false/true
        DB::beginTransaction();
        try {
            Account::editAccount([['id',$admin_data['id']]],['mobile'=>$mobile]);
            if ($id){//判断是否存在该数据
                AccountInfo::editAccountInfo([['account_id',$admin_data['id']]],['realname'=>$realname]);
            }else{
                $admininfo = ['account_id'=>$admin_data['id'],'realname'=>$realname];
                AccountInfo::addAccountInfo($admininfo);
            }
            //添加操作日志
            if ($admin_data['is_super'] == 1){//超级管理员操作商户的记录
                OperationLog::addOperationLog('1','1','1',$route_name,'在商户系统修改了商户的个人账号信息！');//保存操作记录
            }else{//商户本人操作记录
                OperationLog::addOperationLog('5',$admin_data['organization_id'],$admin_data['id'],$route_name, '修改了个人账号信息');//保存操作记录
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '修改个人账号信息失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '修改个人账号信息成功', 'status' => '1']);
    }

    //安全密码设置页面
    public function safe_password(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                     //获取当前的页面路由
        $account = Account::getOne(['id'=>'1']);            //获取超级管理员账号
        return view('CateringBranch/Account/safe_password',['account'=>$account,'admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }

    //安全密码修改设置处理
    public function safe_password_edit_check(Request $request)
    {
        $admin_data = $request->get('admin_data');                  //中间件产生的管理员数据参数
        $route_name = $request->path();                             //获取当前的页面路由
        $is_editing = $request->input('is_editing');                //是否修改安全密码
        $old_safe_password = $request->input('old_safe_password');  //原安全密码
        $safe_password = $request->input('safe_password');          //新安全密码
        $account = Account::getOne(['id'=>'1']);                    //查询超级管理员的安全密码
        if ($admin_data['is_super'] == 1){                          //如果是超级管理员获取零壹安全密码加密盐
            $safe_password_check = $account['safe_password'];
            $key = config("app.zerone_safe_encrypt_key");//获取加安全密码密盐（零壹平台专用）
        }else{
            $safe_password_check = $admin_data['safe_password'];
            $key = config("app.branch_safe_encrypt_key");//获取安全密码加密盐（分店专用）
        }
        //原安全密码处理
        $old_encrypted = md5($old_safe_password);//加密原安全密码第一重
        $old_encryptPwd = md5("lingyikeji".$old_encrypted.$key);//加密原安全密码第二重
        //新安全密码处理
        $encrypted = md5($safe_password);//加密安全密码第一重
        $encryptPwd = md5("lingyikeji".$encrypted.$key);//加密安全密码第二重
        if ($is_editing == '-1'){//设置安全密码
            DB::beginTransaction();
            try {
                //添加操作日志
                if ($admin_data['is_super'] == 1){//超级管理员操作分店的记录
                    Account::editAccount([['id','1']],['safe_password' => $encryptPwd]);                        //设置超级管理员安全密码
                    OperationLog::addOperationLog('1','1','1',$route_name,'在分店管理系统设置了自己的安全密码！');    //保存操作记录
                }else{//分店本人操作记录
                    Account::editAccount([['id',$admin_data['id']]],['safe_password' => $encryptPwd]);          //设置商户安全密码
                    OperationLog::addOperationLog('5',$admin_data['organization_id'],$admin_data['id'],$route_name,'设置了安全密码');//保存操作记录
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();//事件回滚
                return response()->json(['data' => '设置安全密码失败，请检查', 'status' => '0']);
            }
            $admin_data['safe_password'] = $encryptPwd;
            ZeroneRedis::create_branch_account_cache($admin_data['id'],$admin_data);//生成账号数据的Redis缓存
            return response()->json(['data' => '安全密码设置成功', 'status' => '1']);
        }else{//修改安全密码
            if ($safe_password_check == $old_encryptPwd){
                DB::beginTransaction();
                try {
                    //添加操作日志
                    if ($admin_data['is_super'] == 1){//超级管理员操作分店的记录
                        Account::editAccount([['id','1']],['safe_password' => $encryptPwd]);                        //修改超级管理员安全密码
                        OperationLog::addOperationLog('1','1','1',$route_name,'在分店管理系统修改了自己的安全密码！');    //保存操作记录
                    }else{//商户本人操作记录
                        Account::editAccount([['id',$admin_data['id']]],['safe_password' => $encryptPwd]);          //设置商户安全密码
                        OperationLog::addOperationLog('5',$admin_data['organization_id'],$admin_data['id'],$route_name,'修改了安全密码');//保存操作记录
                    }
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();//事件回滚
                    return response()->json(['data' => '安全密码修改失败，请检查', 'status' => '0']);
                }
                $admin_data['safe_password'] = $encryptPwd;
                ZeroneRedis::create_company_account_cache($admin_data['id'],$admin_data);//生成账号数据的Redis缓存
                return response()->json(['data' => '安全密码修改成功！', 'status' => '1']);
            }else{
                return response()->json(['data' => '原安全密码不正确！', 'status' => '0']);
            }
        }
    }

    //登录密码页面
    public function password(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                     //获取当前的页面路由
        $account = Account::getOne(['id'=>'1']);            //获取超级管理员账号
        if (empty($admin_data['safe_password'])){
            return redirect('cateringbranch/account/safe_password');
        }else{
            return view('CateringBranch/Account/password',['account'=>$account,'admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
        }
    }

    //登录密码修改处理
    public function password_edit_check(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $password = $request->input('password');
        $new_password = $request->input('new_password');
        if ($admin_data['is_super'] == 1){//如果是超级管理员获取零壹加密盐
            $account = Account::getOne([['id','1']]);
            $key = config("app.zerone_encrypt_key");//获取加密盐（零壹平台专用）
        }else{
            $account = Account::getOne([['id',$admin_data['id']]]);
            $key = config("app.catering_branch_encrypt_key");//获取加密盐（分店专用）
        }
        $encrypted = md5($password);//加密密码第一重
        $encryptPwd = md5("lingyikeji".$encrypted.$key);//加密密码第二重
        $new_encrypted = md5($new_password);//加密新密码第一重
        $new_encryptPwd = md5("lingyikeji".$new_encrypted.$key);//加密新码第二重
        if ($account['password'] == $encryptPwd){
            DB::beginTransaction();
            try {
                //添加操作日志
                if ($admin_data['is_super'] == 1){//超级管理员操作商户的记录
                    Account::editAccount([['id','1']],['password' => $new_encryptPwd]);                    //修改超级管理员登录密码
                    OperationLog::addOperationLog('1','1','1',$route_name,'在餐饮分店管理系统修改了自己的登录密码！');  //保存操作记录
                }else{//餐饮分店本人操作记录
                    Account::editAccount([['id',$admin_data['id']]],['password' => $new_encryptPwd]);      //修改餐饮分店登录密码
                    OperationLog::addOperationLog('5',$admin_data['organization_id'],$admin_data['id'],$route_name,'修改了登录密码');//保存操作记录
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();//事件回滚
                return response()->json(['data' => '修改登录密码失败，请检查', 'status' => '0']);
            }
            if ($admin_data['is_super'] == 1){
                return response()->json(['data' => '这里修改的是您自己的登录密码！你已经修改了你自己的登录密码！请牢记！', 'status' => '1']);
            }else{
                return response()->json(['data' => '登录密码修改成功！', 'status' => '1']);
            }
        }else{
            return response()->json(['data' => '原密码不正确！', 'status' => '1']);
        }
    }


    //个人操作日志页面
    public function operation_log(Request $request)
    {
        $admin_data = $request->get('admin_data');      //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');        //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();                 //获取当前的页面路由
        $time_st = $request->input('time_st');          //查询时间开始
        $time_nd = $request->input('time_nd');          //查询时间结束
        $account = $request->input('account');          //查询操作账户
        $time_st_format = $time_nd_format = 0;          //实例化时间格式
        if(!empty($time_st) && !empty($time_nd)) {
            $time_st_format = strtotime($time_st . ' 00:00:00');//开始时间转时间戳
            $time_nd_format = strtotime($time_nd . ' 23:59:59');//结束时间转时间戳
        }
        //只查询自己相关的数据
        $where = [
            ['account_id',$admin_data['id']],
            ['program_id','5'], //查询program_id(5)餐饮管理系统的操作日志
            ['organization_id',$admin_data['organization_id']]
        ];
        $search_data = ['time_st'=>$time_st,'time_nd'=>$time_nd,'account'=>$account];
        $operation_log_list = OperationLog::getPaginate($where,$time_st_format,$time_nd_format,10,'id');//操作记录
        return view('CateringBranch/Account/operation_log',['search_data'=>$search_data,'operation_log_list'=>$operation_log_list,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    //个人登录日志页面
    public function login_log(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                     //获取当前的页面路由
        $time_st = $request->input('time_st');              //查询时间开始
        $time_nd = $request->input('time_nd');              //查询时间结束
        $account = $request->input('account');              //查询操作账户
        $time_st_format = $time_nd_format = 0;              //实例化时间格式
        if(!empty($time_st) && !empty($time_nd)) {
            $time_st_format = strtotime($time_st . ' 00:00:00');//开始时间转时间戳
            $time_nd_format = strtotime($time_nd . ' 23:59:59');//结束时间转时间戳
        }
        //只查询自己相关的数据
        $where = [
            ['account_id',$admin_data['id']],
            ['program_id','5'], //查询program_id(5)餐饮管理系统的操作日志
            ['organization_id',$admin_data['organization_id']]
        ];
        $search_data = ['time_st'=>$time_st,'time_nd'=>$time_nd,'account'=>$account];
        $login_log_list = LoginLog::getPaginate($where,$time_st_format,$time_nd_format,10,'id');//登录记录
        return view('CateringBranch/Account/login_log',['search_data'=>$search_data,'login_log_list'=>$login_log_list,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    public function message_setting(Request $request)
    {
        $admin_data = $request->get('admin_data');      //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');        //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();                 //获取当前的页面路由
        return view('CateringBranch/Account/message_setting',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }


}
?>