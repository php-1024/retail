<?php
/**
 *餐饮分店管理系统
 **/

namespace App\Http\Controllers\Retail;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\CateringGoods;
use App\Models\CateringOrder;
use App\Models\CateringOrderGoods;
use App\Models\Organization;
use Illuminate\Http\Request;
use Session;

class OrderController extends Controller
{
    //订单管理-现场订单
    public function order_spot(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        $restaurant_id = Organization::getPluck(['id'=>$admin_data['organization_id']],'parent_id')->first();
        $where = [
            'fansmanage_id' => $restaurant_id,
            'order_type' => '1',    //0为未知订单，1为现场订单，2为外卖订单，3为预约订单
            'restaurant_id' => $admin_data['organization_id'],
        ];
        $list = CateringOrder::getPaginage($where,10,'created_at','DESC');
        foreach ( $list as $key=>$val){
            $account = Account::getOne([['id',$val->user_id]]);
            $val->account = $account;
        }
        return view('Retail/Order/order_spot',['list'=>$list,'admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }

    //订单管理-现场订单详情
    public function order_spot_detail(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        $id = $request->get('id');
        $order = CateringOrder::getOne([['id',$id]]);
        $account = Account::getOne([['id',$order->user_id]]);    //查询处理订单信息和用户信息
        $order->account = $account;
        $order_goods = CateringOrderGoods::getList([['order_id',$order->id]],0,'id','DESC');
        $order_price = 0.00;    //设置订单的初始总价
        foreach ($order_goods as $key=>$val){
            $goods = CateringGoods::getOne([['id',$val->goods_id]]);
            $val->order_goods = $goods;
            $order_price += $val->price;        //计算订单总价
        }
        return view('Retail/Order/order_spot_detail',['order_price'=>$order_price,'order_goods'=>$order_goods,'order'=>$order,'admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }


    //修改订单状态确认密码弹窗
    public function order_status(Request $request)
    {
        $order_id = $request->get('order_id');          //订单ID
        $status = $request->get('status');              //订单状态
        return view('Retail/Order/order_delete',['order_id'=>$order_id,'status'=>$status]);
    }

    //修改订单状态确认操作
    public function order_status_check(Request $request)
    {
        $admin_data = $request->get('admin_data');           //中间件产生的管理员数据参数
        $route_name = $request->path();                          //获取当前的页面路由
        $goods_id = $request->get('goods_id');        //获取分类栏目ID
        DB::beginTransaction();
        try {
            CateringGoods::select_delete($goods_id);
            //添加操作日志
            if ($admin_data['is_super'] == 1) {//超级管理员操作商户的记录
                OperationLog::addOperationLog('1', '1', '1', $route_name, '在零售店铺管理系统删除了商品！');//保存操作记录
            } else {//分店本人操作记录
                OperationLog::addOperationLog('10', $admin_data['organization_id'], $admin_data['id'], $route_name, '删除商品！');//保存操作记录
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '删除商品失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '删除商品成功', 'status' => '1']);
    }

}

?>