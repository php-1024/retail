<?php
/**
 *账户中心
 *
 **/
namespace App\Http\Controllers\Company;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountInfo;
use App\Models\LoginLog;
use App\Models\OperationLog;
use App\Models\Organization;
use App\Models\OrganizationCompanyinfo;
use App\Services\ZeroneRedis\ZeroneRedis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class AccountcenterController extends Controller{

    //系统管理首页
    public function display(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                     //获取当前的页面路由
        if($admin_data['is_super'] == 1 && $admin_data['organization_id'] == 0){    //如果是超级管理员并且组织ID等于零则进入选择组织页面
            return redirect('company/company_list');
        }
        $organization = Organization::getOneCompany(['id' => $admin_data['organization_id']]);
        if (empty($admin_data['safe_password'])){           //先设置安全密码
            return redirect('company/account/password');
        }else{
            return view('Company/Accountcenter/display',['organization'=>$organization,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
        }
    }

    //商户列表（超级管理员使用）
    public function company_list(Request $request)
    {
        $admin_data = $request->get('admin_data');                          //中间件产生的管理员数据参数
        if($admin_data['id'] != 1 && $admin_data['organization_id'] != 0){  //如果是超级管理员并且已经切换身份成功则跳转
            return redirect('company');
        }
        $organization_name  = $request->organization_name;
        $where = ['type'=>'3'];
        $organization = Organization::getCompanyAndWarzone($organization_name,$where,20,'id','ASC');
        foreach ($organization as $key=>$val){
            $proxy = Organization::getOneProxy(['id'=>$val->parent_id]);
            $val->proxyname = $proxy->organization_name;
        }
        return  view('Company/Accountcenter/company_list',['organization'=>$organization,'organization_name'=>$organization_name]);
    }

    //选择商户
    public function company_select(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $account_id = $request->account_id;           //获取当前选择店铺的组织
        dd($account_id);
        //如果是超级管理员且商户组织ID有值并且当前管理员的组织ID为空
        if ($admin_data['is_super'] == '1' && $admin_data['organization_id'] == 0){
            $this->superadmin_login($account_id);      //超级管理员选择身份登录
            return response()->json(['data' => '成功选择商户，即将前往该商户！', 'status' => '1']);
        }else{
            return response()->json(['data' => '操作失败，请稍后再试！', 'status' => '1']);
        }

    }

    //商户信息编辑
    public function compant_info_edit_check(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $route_name = $request->path();                     //获取当前的页面路由
        $id = $request->organization_id;                    //接收组织id
        $organization_name = $request->organization_name;   //接收组织商户名称
        $mobile = $request->company_owner_mobile;           //接收负责人手机号码
        $list = Organization::getOneCompany(['id'=>$id]);   //获取商户组织信息
        DB::beginTransaction();
        try{
            if($list['organization_name']!=$organization_name){
                Organization::editOrganization(['id'=>$id], ['organization_name'=>$organization_name]);//修改服务商表服务商名称
            }
            if($list['mobile']!=$mobile){
                OrganizationCompanyinfo::editOrganizationCompanyinfo(['organization_id'=>$id], ['company_owner_mobile'=>$mobile]);//修改商户表商户手机号码
                Account::editAccount(['organization_id'=>$id],['mobile'=>$mobile]);//修改用户管理员信息表 手机号
            }
            //添加操作日志
            if ($admin_data['is_super'] == 1){//超级管理员操作商户的记录
                OperationLog::addOperationLog('1','1','1',$route_name,'在商户系统修改了商户（'.$admin_data['account'].'）的公司资料！');//保存操作记录
            }else{//商户本人操作记录
                OperationLog::addOperationLog('3',$admin_data['organization_id'],$admin_data['id'],$route_name,'修改了公司资料');//保存操作记录
            }
            DB::commit();//提交事务
        }catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '修改失败', 'status' => '0']);
        }
        return response()->json(['data' => '修改成功', 'status' => '1']);
    }

    //超级管理员退出当前商户（切换商户）
    public function company_switch(Request $request){
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $admin_data['organization_id'] = 0;
        ZeroneRedis::create_company_account_cache(1,$admin_data);//清空所选组织
        return redirect('company');
    }

    //账号信息修改页面
    public function profile(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                     //获取当前的页面路由
        $user = Account::getOne(['id'=>$admin_data['id']]);
        return view('Company/Accountcenter/profile',['user'=>$user,'admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }

    //账号信息修改处理
    public function profile_edit_check(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $realname = $request->input('realname');
        $mobile = $request->input('mobile');
        DB::beginTransaction();
        try {
            Account::editAccount([['id',$admin_data['id']]],['mobile'=>$mobile]);
            AccountInfo::editAccountInfo([['account_id',$admin_data['id']]],['realname'=>$realname]);
            //添加操作日志
            if ($admin_data['is_super'] == 1){//超级管理员操作商户的记录
                OperationLog::addOperationLog('1','1','1',$route_name,'在商户系统修改了商户的个人账号信息！');//保存操作记录
            }else{//商户本人操作记录
                OperationLog::addOperationLog('3',$admin_data['organization_id'],$admin_data['id'],$route_name, '修改了个人账号信息');//保存操作记录
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '修改个人账号信息失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '修改个人账号信息成功', 'status' => '1']);
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
            return redirect('company/account/safe_password');
        }else{
            return view('Company/Accountcenter/password',['account'=>$account,'admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
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
            $key = config("app.company_encrypt_key");//获取加密盐（商户专用）
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
                    OperationLog::addOperationLog('1','1','1',$route_name,'在商户管理系统修改了自己的登录密码！');  //保存操作记录
                }else{//商户本人操作记录
                    Account::editAccount([['id',$admin_data['id']]],['password' => $new_encryptPwd]);      //修改商户登录密码
                    OperationLog::addOperationLog('3',$admin_data['organization_id'],$admin_data['id'],$route_name,'修改了登录密码');//保存操作记录
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

    //安全密码设置页面
    public function safe_password(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                     //获取当前的页面路由
        $account = Account::getOne(['id'=>'1']);            //获取超级管理员账号
        return view('Company/Accountcenter/safe_password',['account'=>$account,'admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
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
            $key = config("app.company_safe_encrypt_key");//获取安全密码加密盐（商户专用）
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
                if ($admin_data['is_super'] == 1){//超级管理员操作商户的记录
                    Account::editAccount([['id','1']],['safe_password' => $encryptPwd]);                        //设置超级管理员安全密码
                    OperationLog::addOperationLog('1','1','1',$route_name,'在商户管理系统设置了自己的安全密码！');    //保存操作记录
                }else{//商户本人操作记录
                    Account::editAccount([['id',$admin_data['id']]],['safe_password' => $encryptPwd]);          //设置商户安全密码
                    OperationLog::addOperationLog('3',$admin_data['organization_id'],$admin_data['id'],$route_name,'设置了安全密码');//保存操作记录
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();//事件回滚
                return response()->json(['data' => '设置安全密码失败，请检查', 'status' => '0']);
            }
            $admin_data['safe_password'] = $encryptPwd;
            ZeroneRedis::create_company_account_cache($admin_data['id'],$admin_data);//生成账号数据的Redis缓存
            return response()->json(['data' => '安全密码设置成功', 'status' => '1']);
        }else{//修改安全密码
            if ($safe_password_check == $old_encryptPwd){
                DB::beginTransaction();
                try {
                    //添加操作日志
                    if ($admin_data['is_super'] == 1){//超级管理员操作商户的记录
                        Account::editAccount([['id','1']],['safe_password' => $encryptPwd]);                        //修改超级管理员安全密码
                        OperationLog::addOperationLog('1','1','1',$route_name,'在商户管理系统修改了自己的安全密码！');    //保存操作记录
                    }else{//商户本人操作记录
                        Account::editAccount([['id',$admin_data['id']]],['safe_password' => $encryptPwd]);          //设置商户安全密码
                        OperationLog::addOperationLog('3',$admin_data['organization_id'],$admin_data['id'],$route_name,'修改了安全密码');//保存操作记录
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
            ['program_id','3'], //查询program_id(3)商户管理系统的操作日志
            ['organization_id',$admin_data['organization_id']]
        ];
        $search_data = ['time_st'=>$time_st,'time_nd'=>$time_nd,'account'=>$account];
        $operation_log_list = OperationLog::getPaginate($where,$time_st_format,$time_nd_format,10,'id');//操作记录
        return view('Company/Accountcenter/operation_log',['search_data'=>$search_data,'operation_log_list'=>$operation_log_list,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
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
            ['program_id','3'], //查询program_id(3)商户管理系统的操作日志
            ['organization_id',$admin_data['organization_id']]
        ];
        $search_data = ['time_st'=>$time_st,'time_nd'=>$time_nd,'account'=>$account];
        $login_log_list = LoginLog::getPaginate($where,$time_st_format,$time_nd_format,10,'id');//登录记录
        return view('Company/Accountcenter/login_log',['search_data'=>$search_data,'login_log_list'=>$login_log_list,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }


    //退出登录
    public function quit(){
        Session::put('company_account_id','');
        return redirect('company/login');
    }

    //超级管理员以商户平台普通管理员登录处理
    public function superadmin_login($account_id)
    {
        $account_info = Account::getOneAccount([['id',$account_id]]);//根据账号查询
        //Admin登录商户平台要生成的信息
        //重新生成缓存的登录信息
        $admin_data = [
            'id'=>$account_info->id,                            //用户ID
            'organization_id'=>$account_info->organization_id,  //组织ID
            'parent_id'=>$account_info->parent_id,              //上级ID
            'parent_tree'=>$account_info->parent_tree,          //上级树
            'deepth'=>$account_info->deepth,                    //账号在组织中的深度
            'account'=>$account_info->account,                  //用户账号
            'password'=>$account_info->password,                //用户密码
            'safe_password'=>$account_info->safe_password,      //安全密码
            'is_super'=>1,                                      //这里设置成1超级管理员，便于切换各个商户组织
            'status'=>$account_info->status,                    //用户状态
            'mobile'=>$account_info->mobile,                    //绑定手机号
        ];
        Session::put('company_account_id', encrypt(1));         //存储登录session_id为当前用户ID
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
        ZeroneRedis::create_company_account_cache(1, $admin_data);//生成账号数据的Redis缓存
        ZeroneRedis::create_company_menu_cache(1);//生成对应账号的商户系统菜单
    }

}
?>