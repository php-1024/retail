<?php
/**
 *新版本登录界面
 *
 **/
namespace App\Http\Controllers\Company;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountInfo;
use App\Models\OperationLog;
use App\Models\Organization;
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
        $accountInfo = AccountInfo::getOne(['id' => $admin_data['id']]);
        $organization = Organization::getOneProxy(['id' => $admin_data['organization_id']]);
        return view('Company/Accountcenter/display',['organization'=>$organization,'account_info'=>$accountInfo,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    //商户列表（超级管理员使用）
    public function company_list(Request $request)
    {
        $admin_data = $request->get('admin_data');                          //中间件产生的管理员数据参数
        if($admin_data['id'] != 1 && $admin_data['organization_id'] != 0){  //如果是超级管理员并且已经切换身份成功则跳转
            return redirect('company');
        }
        $organization = Organization::getArrayCompany(['type'=>'3']);
        return  view('Company/Accountcenter/company_list',['organization'=>$organization]);
    }

    //选择商户
    public function company_select(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $organization_id = $request->organization_id;
        //如果存在商户组织ID并且当前管理员的组织ID为空
        if (!empty($organization_id) && $admin_data['organization_id'] == 0){
            $this->superadmin_login($organization_id);
        }
        return response()->json(['data' => '成功选择商户，即将前往该商户！', 'status' => '1']);
    }

    //超级管理员退出当前商户（切换商户）
    public function company_quit(Request $request){
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $admin_data['organization_id'] = 0;
        ZeroneRedis::create_super_company_account_cache($admin_data['id'],$admin_data);//清空所选组织
        return redirect('company');
    }

    //公司资料编辑（商户资料）
    public function company_edit()
    {
        dump("test");
    }

    //登录密码
    public function password(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                     //获取当前的页面路由
        return view('Company/Accountcenter/password',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }

    //登录密码修改
    public function password_edit_check(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $account = Account::getOne([['id',$admin_data['id']]]);
        $password = $request->input('password');
        $new_password = $request->input('new_password');
        $key = config("app.company_encrypt_key");//获取加密盐（商户专用）
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

    //安全密码
    public function safe_password(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                     //获取当前的页面路由
        return view('Company/Accountcenter/safe_password',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }







    //退出登录
    public function quit(){
        Session::put('zerone_company_account_id','');       //清除普通商户身份
        Session::put('zerone_super_company_account_id',''); //清除超级管理员身份
        return redirect('company/login');
    }


    //超级管理员以商户平台普通管理员登录处理
    public function superadmin_login($organization_id)
    {
        $account_info = Account::getOneAccount([['organization_id',$organization_id],['parent_id','1']]);//根据账号查询
        //Admin登陆商户平台要生成的信息
        //重新生成缓存的登录信息
        $admin_data = [
            'id'=>$account_info->id,    //用户ID
            'organization_id'=>$account_info->organization_id,//组织ID
            'parent_id'=>$account_info->parent_id,//上级ID
            'parent_tree'=>$account_info->parent_tree,//上级树
            'deepth'=>$account_info->deepth,//账号在组织中的深度
            'account'=>$account_info->account,//用户账号
            'password'=>$account_info->password,//用户密码
            'safe_password'=>$account_info->safe_password,//安全密码
            'is_super'=>1,//这里设置成1超级管理员，便于切换各个商户组织
            'status'=>$account_info->status,//用户状态
            'mobile'=>$account_info->mobile,//绑定手机号
        ];
        Session::put('zerone_company_account_id','');//清空普通用户
        Session::put('zerone_super_company_account_id', encrypt($admin_data['id']));//存储登录session_id为当前用户ID
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
        ZeroneRedis::create_super_company_account_cache($account_info->id, $admin_data);//生成账号数据的Redis缓存
        ZeroneRedis::create_company_menu_cache($account_info->id);//生成对应账号的商户系统菜单
    }

}
?>