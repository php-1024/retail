<?php
/**
 *新版本登录界面
 *
 **/
namespace App\Http\Controllers\Company;
use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use Session;

class AccountcenterController extends Controller{

    //系统管理首页
    public function display(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $organization = Organization::getlist(['type','3']);
        dump($organization);
        if(!empty($admin_data['super_id']) && $admin_data['super_id'] == 1){
            return  view('Company/Accountcenter/company_organization');
        }else{
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