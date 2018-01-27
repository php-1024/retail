<?php
/**
 *新版本登录界面
 *
 **/
namespace App\Http\Controllers\Company;
use App\Http\Controllers\Controller;
use App\Models\AccountInfo;
use App\Models\Organization;
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
        dump($admin_data);
        if(!empty($admin_data['super_id']) && $admin_data['super_id'] == 1){
            $organization = Organization::getlist(['type'=>'3']); //如何是admin则获取所有组织信息
            if (!empty($request->organization_id)){
                dump($request->organization_id);
                return view('Company/Accountcenter/display',['organization_id'=>$request->organization_id,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
            }else{
                return  view('Company/Accountcenter/company_organization',['organization'=>$organization]);
            }
        }else{//不是超级管理员
            $accountInfo = AccountInfo::getOne([]);
            dump($accountInfo);
            dump($admin_data['organization_id']);
            return view('Company/Accountcenter/display',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
        }
    }

    //退出登录
    public function quit(Request $request){
        Session::put('zerone_company_account_id','');
        return redirect('company/login');
    }
}
?>