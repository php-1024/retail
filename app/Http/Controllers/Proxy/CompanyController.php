<?php
namespace App\Http\Controllers\Proxy;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Organization;
use App\Models\ProxyApply;
use Illuminate\Http\Request;
use Session;
class CompanyController extends Controller{
    //商户注册列表
    public function company_register(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $proxy_name = $request->input('proxy_name');
        $proxy_owner_mobile = $request->input('proxy_owner_mobile');
        $search_data = ['proxy_name'=>$proxy_name,'proxy_owner_mobile'=>$proxy_owner_mobile];

        $where = [['parent_id',$admin_data['organization_id']]];
        if(!empty($proxy_name)){
            $where[] = ['proxy_name','like','%'.$proxy_name.'%'];
        }
        if(!empty($proxy_owner_mobile)){
            $where[] = ['proxy_owner_mobile',$proxy_owner_mobile];
        }
        $list = ProxyApply::getPaginage($where,'15','id');
        return view('Proxy/Company/company_register',['list'=>$list,'search_data'=>$search_data,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    //商户列表
    public function company_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $organization = $admin_data['organization_id'];
        $list = Organization::getCompany([['parent_id',$organization],['program_id',3]],10,'id');
        foreach ($list as $key=>$val){
           $account = Account::getPluck([['organization_id',$val['id']],['parent_id',1]],'account')->first();
           dump($account);
        }
        return view('Proxy/Company/company_list',['list'=>$list,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }


}
?>