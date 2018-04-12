<?php

namespace App\Http\Controllers\Zerone;

use App\Http\Controllers\Controller;
use App\Models\OperationLog;
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
     * pos终端机审核ajax显示
     */
    public function payconfig_apply(Request $request)
    {
        // pos终端机id
        $id = $request->id;
        // 状态值1表示审核通过，-1表示拒绝通过
        $status = $request->status;

        return view('Zerone/Paysetting/payconfig_apply',['id'=>$id,'status'=>$status]);
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
     * pos终端机审核ajax显示
     */
    public function shengpay_apply(Request $request)
    {
        // pos终端机id
        $id = $request->id;
        // 状态值1表示审核通过，-1表示拒绝通过
        $status = $request->status;

        return view('Zerone/Paysetting/shengpay_apply',['id'=>$id,'status'=>$status]);
    }


    /**
     * pos终端机审核提交
     */
    public function shengpay_apply_check(Request $request)
    {
        // 中间件产生的管理员数据参数
        $admin_data = $request->get('admin_data');
        // 获取当前的页面路由
        $route_name = $request->path();
        // pos终端机id
        $id = $request->id;
        // 状态值1表示审核通过，-1表示拒绝通过
        $status = $request->status;
        // 查询终端号
        $terminal_num = RetailShengpayTerminal::getPluck([['id',$id]],'terminal_num');
        // 如果查不到 打回
        if(empty($terminal_num)){
            return response()->json(['data' => '查不到数据', 'status' => '0']);
        }
        DB::beginTransaction();
        try {
            // 修改终端号状态
            RetailShengpayTerminal::editShengpayTerminal([['id',$id]],['status'=>$status]);

            if($status == '1'){
                // 添加操作日志
                OperationLog::addOperationLog('1', $admin_data['organization_id'], $admin_data['id'], $route_name, '审核通过了终端号：' . $terminal_num);
            }else{
                // 添加操作日志
                OperationLog::addOperationLog('1', $admin_data['organization_id'], $admin_data['id'], $route_name, '拒绝通过了终端号：' . $terminal_num);
            }

            DB::commit();
        } catch (\Exception $e) {
            // 事件回滚
            DB::rollBack();
            return response()->json(['data' => '操作失败', 'status' => '0']);
        }
        return response()->json(['data' => '操作成功', 'status' => '1']);
    }

}

?>