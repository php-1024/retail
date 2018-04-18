<?php

namespace App\Http\Controllers\Zerone;

use App\Http\Controllers\Controller;
use App\Models\OperationLog;
use App\Models\Organization;
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
        // 店铺名称
        $organization_name = $request->organization_name;
        $where = [];
        if($organization_name){
            $where[] = ['organization_name','LIKE',"%{$organization_name}%"];
        }
        $search_data = ['organization_name' => $organization_name];

        $data = RetailShengpay::from('retail_shengpay as r')->join('organization as o','retail_shengpay.retail_id','=','o.id')->orderBy('retail_shengpay.id', 'DESC')->select('retail_shengpay.id as rid','o.id')->paginate('15');
        dump($data);
        // 查询收款信息列表
        $list = RetailShengpay::getPaginage([], 15, 'id');

        return view('Zerone/Paysetting/payconfig', ['search_data' => $search_data, 'list' => $list, 'admin_data' => $admin_data, 'route_name' => $route_name, 'menu_data' => $menu_data, 'son_menu_data' => $son_menu_data]);
    }

    /**
     * 收款信息审核ajax显示
     */
    public function payconfig_apply(Request $request)
    {
        // pos终端机id
        $id = $request->id;
        // 状态值1表示审核通过，-1表示拒绝通过
        $status = $request->status;
        // 店铺id
        $retail_id = $request->retail_id;

        $retail_name = Organization::getPluck([['id', $retail_id]], 'organization_name');


        return view('Zerone/Paysetting/payconfig_apply', ['retail_name' => $retail_name, 'id' => $id, 'status' => $status]);
    }

    /**
     * 收款信息审核功能提交
     */
    public function payconfig_apply_check(Request $request)
    {
        // 中间件产生的管理员数据参数
        $admin_data = $request->get('admin_data');
        // 获取当前的页面路由
        $route_name = $request->path();
        // 付款信息id
        $id = $request->id;
        // 状态值1表示审核通过，-1表示拒绝通过
        $status = $request->status;
        // 店铺名称
        $retail_name = $request->retail_name;

        DB::beginTransaction();
        try {
            // 修改付款信息状态
            RetailShengpay::editShengpay([['id', $id]], ['status' => $status]);

            $name = $status == '1'? ('审核通过了付款信息店铺：'):('拒绝了付款信息店铺：');
            // 添加操作日志
            OperationLog::addOperationLog('1', $admin_data['organization_id'], $admin_data['id'], $route_name, $name . $retail_name);

            DB::commit();
        } catch (\Exception $e) {
            // 事件回滚
            DB::rollBack();
            return response()->json(['data' => '操作失败', 'status' => '0']);
        }
        return response()->json(['data' => '操作成功', 'status' => '1']);
    }

    /**
     * 收款信息审核功能提交
     */
    public function payconfig_type(Request $request)
    {
        // 中间件产生的管理员数据参数
        $admin_data = $request->get('admin_data');
        // 获取当前的页面路由
        $route_name = $request->path();
        // 付款信息id
        $id = $request->id;
        // 到款方式
        $type = $request->type;

        switch ($type) {
            case "0":
                $name = '未设置';
                break;
            case "1":
                $name = 'T0';
                break;
            case "2":
                $name = 'T1';
                break;
        }

        // 店铺id
        $retail_id = $request->retail_id;

        // 店铺名称
        $retail_name = Organization::getPluck([['id', $retail_id]], 'organization_name');

        DB::beginTransaction();
        try {
            // 修改付款信息状态
            RetailShengpay::editShengpay([['id', $id]], ['type' => $type]);
            // 添加操作日志
            OperationLog::addOperationLog('1', $admin_data['organization_id'], $admin_data['id'], $route_name, '修改了' . $retail_name . '付款状态：' . $name);
            DB::commit();
        } catch (\Exception $e) {
            // 事件回滚
            DB::rollBack();
            return response()->json(['data' => '操作失败', 'status' => '0']);
        }
        return response()->json(['data' => '操作成功', 'status' => '1']);
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
        return view('Zerone/Paysetting/shengpay', ['search_data' => $search_data, 'list' => $list, 'admin_data' => $admin_data, 'route_name' => $route_name, 'menu_data' => $menu_data, 'son_menu_data' => $son_menu_data]);
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
        // 店铺id
        $retail_id = $request->retail_id;
        // 店铺名称
        $retail_name = Organization::getPluck([['id', $retail_id]], 'organization_name');

        return view('Zerone/Paysetting/shengpay_apply', ['retail_name' => $retail_name, 'id' => $id, 'status' => $status]);
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
        // 店铺名称
        $retail_name = $request->retail_name;
        // 查询终端号
        $terminal_num = RetailShengpayTerminal::getPluck([['id', $id]], 'terminal_num');
        // 如果查不到 打回
        if (empty($terminal_num)) {
            return response()->json(['data' => '查不到数据', 'status' => '0']);
        }
        DB::beginTransaction();
        try {
            // 修改终端号状态
            RetailShengpayTerminal::editShengpayTerminal([['id', $id]], ['status' => $status]);

            $name = $status == '1'? ('审核通过了--'):('拒绝通过了--');

            // 添加操作日志
            OperationLog::addOperationLog('1', '1', $admin_data['id'], $route_name, $name . $retail_name . '--终端号：' . $terminal_num);

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