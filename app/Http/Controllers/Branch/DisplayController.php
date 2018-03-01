<?php
/**
 *餐饮分店管理系统
 * 登录界面
 **/

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use Session;

class DisplayController extends Controller
{
    /*
     * 登录页面
     */
    public function display(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                     //获取当前的页面路由
        if($admin_data['is_super'] == 1 && $admin_data['organization_id'] == 0){    //如果是超级管理员并且组织ID等于零则进入选择组织页面
            return redirect('Branch/company_list');
        }
        $organization = Organization::getOneCompany(['id' => $admin_data['organization_id']]);
//        if (empty($admin_data['safe_password'])){           //先设置安全密码
//            return redirect('Branch/account/password');
//        }else{
            return view('Branch/Display/display',['organization'=>$organization,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
//        }
    }
}

?>