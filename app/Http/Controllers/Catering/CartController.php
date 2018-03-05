<?php
namespace App\Http\Controllers\Catering;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
class CardController extends Controller{
    //添加会员卡
    public function card_add(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        return view('Catering/Card/card_add',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    //会员卡管理
    public function card_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        return view('Catering/Card/card_list',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    //调整适用商品
    public function card_goods(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        return view('Catering/Card/card_goods',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
}
?>