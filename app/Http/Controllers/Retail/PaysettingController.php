<?php
/**
 * 零售管理系统
 * 支付设置
 **/

namespace App\Http\Controllers\Retail;

use App\Http\Controllers\Controller;
use App\Models\OperationLog;
use App\Models\RetailShengpayTerminal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class PaysettingController extends Controller
{

    /**
     * 添加终端机器号信息
     */
    public function shengpay_add(Request $request)
    {
        // 中间件产生的管理员数据参数
        $admin_data = $request->get('admin_data');
        // 中间件产生的菜单数据参数
        $menu_data = $request->get('menu_data');
        // 中间件产生的子菜单数据参数
        $son_menu_data = $request->get('son_menu_data');
        // 获取当前的页面路由
        $route_name = $request->path();

        return view('Retail/Paysetting/shengpay_add', ['admin_data' => $admin_data, 'menu_data' => $menu_data, 'son_menu_data' => $son_menu_data, 'route_name' => $route_name]);
    }

    /**
     * 添加终端机器号信息
     */
    public function shengpay_add_check(Request $request)
    {
        // 中间件产生的管理员数据参数
        $admin_data = $request->get('admin_data');
        // 店铺id
        $retail_id = $admin_data['organization_id'];
        // 获取当前的页面路由
        $route_name = $request->path();
        // 终端号
        $terminal_num = $request->terminal_num;
        if (RetailShengpayTerminal::checkRowExists([['terminal_num', $terminal_num]])) {
            return response()->json(['data' => '该终端号已绑定！', 'status' => '0']);
        }
        DB::beginTransaction();
        try {
            // 数据处理
            $data = [
                // 店铺id
                'retail_id' => $retail_id,
                // 终端号
                'terminal_num' => $terminal_num,
            ];
            // 添加终端号
            RetailShengpayTerminal::addShengpayTerminal($data);
            // 如果不是超级管理员
            if ($admin_data['is_super'] != 1) {
                // 保存操作记录
                OperationLog::addOperationLog('10', $admin_data['organization_id'], $admin_data['id'], $route_name, '添加了终端号：' . $terminal_num);
            }
            // 事件提交
            DB::commit();
        } catch (\Exception $e) {
            // 事件回滚
            DB::rollBack();
            return response()->json(['data' => '添加失败！', 'status' => '0']);
        }
        return response()->json(['data' => '添加成功！', 'status' => '1']);
    }

    /**
     * 终端机器号信息列表
     */
    public function shengpay_list(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的菜单数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的子菜单数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        return view('Retail/Paysetting/shengpay_list', ['admin_data' => $admin_data, 'menu_data' => $menu_data, 'son_menu_data' => $son_menu_data, 'route_name' => $route_name]);
    }

    public function shengf_setting(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的菜单数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的子菜单数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        return view('Retail/Paysetting/zerone_setting', ['admin_data' => $admin_data, 'menu_data' => $menu_data, 'son_menu_data' => $son_menu_data, 'route_name' => $route_name]);
    }

    public function kuaifu_setting(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的菜单数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的子菜单数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        return view('Retail/Paysetting/zerone_setting', ['admin_data' => $admin_data, 'menu_data' => $menu_data, 'son_menu_data' => $son_menu_data, 'route_name' => $route_name]);
    }
}

?>