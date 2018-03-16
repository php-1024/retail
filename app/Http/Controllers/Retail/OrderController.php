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

    //订单管理-外卖订单详情
    public function order_takeout_detail(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        return view('Retail/Order/order_takeout_detail',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
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
        foreach ($order_goods as $key=>$val){
            $goods = CateringGoods::getOne([['id',$val->goods_id]]);
            $val->order_goods = $goods;
        }
        dd($order_goods);
        return view('Retail/Order/order_spot_detail',['order_goods'=>$order_goods,'order'=>$order,'admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }

    //订单管理-外卖订单
    public function order_takeout(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        return view('Retail/Order/order_takeout',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }

    //预约管理
    public function order_appointment(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        return view('Retail/Order/order_appointment',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }

}

?>