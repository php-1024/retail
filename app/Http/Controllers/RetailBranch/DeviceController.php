<?php
/**
 *餐饮分店管理系统
 **/

namespace App\Http\Controllers\RetailBranch;

use App\Http\Controllers\Controller;
use App\Models\CateringRoom;
use App\Models\OperationLog;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class DeviceController extends Controller
{
    //设备管理-添加包厢
    public function room_add(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        return view('RetailBranch/Device/room_add',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }

    //设备管理-添加包厢检测
    public function room_add_check(Request $request)
    {
        $admin_data = $request->get('admin_data');      //中间件产生的管理员数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        $room_name = $request->get('room_name');    //栏目名称
        $store_id = Organization::getPluck(['id'=>$admin_data['organization_id']],'parent_id')->first();
        $room_data = [
            'name' => $room_name,
            'store_id' => $store_id,
            'branch_id' => $admin_data['organization_id'],
        ];
        DB::beginTransaction();
        try {
            CateringRoom::addRoom($room_data);
            //添加操作日志
            if ($admin_data['is_super'] == 1){//超级管理员操作商户的记录
                OperationLog::addOperationLog('1','1','1',$route_name,'在餐饮分店管理系统添加了包厢！');//保存操作记录
            }else{//商户本人操作记录
                OperationLog::addOperationLog('5',$admin_data['organization_id'],$admin_data['id'],$route_name, '添加了包厢！');//保存操作记录
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '添加包厢失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '添加包厢信息成功', 'status' => '1']);
    }

    //设备管理-包厢管理
    public function room_list(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        $store_id = Organization::getPluck(['id'=>$admin_data['organization_id']],'parent_id')->first();
        $where = [
            'store_id' => $store_id,
            'branch_id' => $admin_data['organization_id'],
        ];
        $room = CateringRoom::getPaginage($where,10,'created_at','DESC');
        return view('RetailBranch/Device/room_list',['room'=>$room,'admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }

    //设备管理-添加餐桌
    public function table_add(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        return view('RetailBranch/Device/table_add',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }

    //设备管理-餐桌管理
    public function table_list(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        return view('RetailBranch/Device/table_list',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }

    //设备管理-添加打印机
    public function printer_add(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        return view('RetailBranch/Device/printer_add',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }

    //设备管理-打印机管理
    public function printer_list(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        return view('RetailBranch/Device/printer_list',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }

    //设备管理-打印机关联商品
    public function printer_goods(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        return view('RetailBranch/Device/printer_goods',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }

}

?>