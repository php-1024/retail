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
        $companyinfo = $request->companyinfo;
        if (!empty($companyinfo)){
            $companyinfo_arr = json_decode($companyinfo,true);
            $organization_id = $companyinfo_arr['organization_id'];
            $account_info = Account::getOneAccount([['organization_id',$organization_id],['parent_id','1']]);//根据账号查询
            //Admin登陆商户平台要生成的信息
            //重新生成缓存的登录信息
            $admin_data = [
                'id'=>$account_info->id,    //用户ID
                'account'=>$account_info->account,//用户账号
                'organization_id'=>$account_info->organization_id,//组织ID
                'is_super'=>$account_info->is_super,//是否超级管理员
                'parent_id'=>$account_info->parent_id,//上级ID
                'parent_tree'=>$account_info->parent_tree,//上级树
                'deepth'=>$account_info->deepth,//账号在组织中的深度
                'mobile'=>$account_info->mobile,//绑定手机号
                'safe_password'=>$account_info->safe_password,//安全密码
                'account_status'=>$account_info->status,//用户状态
                'super_id' => '2' //超级管理员进入后切换身份用
            ];
        }
        if (!empty($request->organization_id)){
            $admin_data['organization_id'] = $request->organization_id;
            \ZeroneRedis::create_company_account_cache($admin_data['id'],$admin_data);//生成账号数据的Redis缓存
        }
        if($admin_data['is_super'] == 1 && $admin_data['organization_id'] == 0){    //如果是超级管理员并且组织ID等于零则进入选择组织页面
            $organization = Organization::getlist(['type'=>'3']);                   //如何是admin则获取所有组织信息
            dump($organization);
            return  view('Company/Accountcenter/company_organization',['organization'=>$organization]);
        }
        dump($request);
        $accountInfo = AccountInfo::getOne(['id' => $admin_data['id']]);
        $organization = Organization::getOne(['id' => $admin_data['organization_id']]);
        return view('Company/Accountcenter/display',['organization'=>$organization,'account_info'=>$accountInfo,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);

    }

    //退出登录
    public function quit(Request $request){
        Session::put('zerone_company_account_id','');
        return redirect('company/login');
    }

    //退出重新选择商户
    public function company_switch(Request $request){
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $admin_data['organization_id'] = 0;
        \ZeroneRedis::create_company_account_cache($admin_data['id'],$admin_data);//生成账号数据的Redis缓存
        return redirect('company');
    }


}
?>