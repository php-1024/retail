<?php

namespace App\Http\Controllers\Zerone;

use App\Http\Controllers\Controller;
use App\Models\RetailShengpay;
use App\Models\RetailShengpayTerminal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class PaysettingController extends Controller
{
    /**
     * 收款信息审核
     */
    public function payconfig(Request $request)
    {
        // 中间件产生的管理员数据参数
        $admin_data = $request->get('admin_data');
        // 中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');
        // 中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');
        // 获取当前的页面路由
        $route_name = $request->path();
        // 查询收款信息列表
        $list = RetailShengpay::getPaginage([], 15, 'id');

        return view('Zerone/Paysetting/payconfig', ['list' => $list, 'admin_data' => $admin_data, 'route_name' => $route_name, 'menu_data' => $menu_data, 'son_menu_data' => $son_menu_data]);
    }

    /**
     * 收款信息审核
     */
    public function shengpay(Request $request)
    {
        // 中间件产生的管理员数据参数
        $admin_data = $request->get('admin_data');
        // 中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');
        // 中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');
        // 获取当前的页面路由
        $route_name = $request->path();
        // 店铺名称
        $organization_name = $request->organization_name;

        $search_data = ['organization_name' => $organization_name];

        // 查询收款信息列表
        $list = RetailShengpayTerminal::getPaginage([], 15, 'id');

        return view('Zerone/Paysetting/shengpay', ['search_data' => $search_data,'list' => $list, 'admin_data' => $admin_data, 'route_name' => $route_name, 'menu_data' => $menu_data, 'son_menu_data' => $son_menu_data]);
    }

    /**
     * 收款信息审核
     */
    public function shengpay_apply(Request $request)
    {
        $id = $request->id;

        $status = $request->status;

        return view('Zerone/Paysetting/shengpay_apply',['id'=>$id,'status'=>$status]);
    }

}

?>