<?php
/**
 *新版本登录界面
 *
 **/
namespace App\Http\Controllers\Company;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountInfo;
use App\Models\Organization;
use App\Services\ZeroneRedis\ZeroneRedis;
use Illuminate\Http\Request;
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
            return redirect('company/company_select');
        }
        $accountInfo = AccountInfo::getOne(['id' => $admin_data['id']]);
        $organization = Organization::getOneProxy(['id' => $admin_data['organization_id']]);
        return view('Company/Accountcenter/display',['organization'=>$organization,'account_info'=>$accountInfo,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    //商户列表
    public function company_select(Request $request)
    {
        dump($request);
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $organization_id = $request->organization_id;
        if($admin_data['is_super'] != 1 && $admin_data['organization_id'] != 0){ //如果是超级管理员已经选择商户组织ID,切换身份成功则跳转
            return redirect('company');
        }
        //是否存在商户选择数据
        if (!empty($organization_id) && $admin_data['organization_id'] == 0){
            $this->superadmin_login($organization_id);
        }
        $organization = Organization::getArrayCompany(['type'=>'3']);
        return  view('Company/Accountcenter/company_organization',['organization'=>$organization]);
    }

    //超级管理员退出当前商户
    public function company_quit(Request $request){
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $admin_data['organization_id'] = 0;
        ZeroneRedis::create_super_company_account_cache($admin_data['id'],$admin_data);//清空所选组织
        return redirect('company');
    }

    //退出登录
    public function quit(){
        Session::put('zerone_company_account_id','');
        Session::put('zerone_super_company_account_id','');
        return redirect('company/login');
    }

    //超级管理员以商户平台登录处理
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
        return redirect("company");
    }

}
?>