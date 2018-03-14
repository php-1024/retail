<?php
/**
 *餐饮分店管理系统
 * 登录界面
 **/

namespace App\Http\Controllers\RetailBranch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class CashierController extends Controller
{
    /*
     * 收银台
     */
    public function cashier(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        return view('CateringBranch/Display/cashier',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }
}

?>