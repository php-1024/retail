<?php
namespace App\Http\Controllers\Retail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
class SubscriptionController extends Controller{
    //公众号设置
    public function setting(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        
        return view('Retail/Subscription/setting',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
}
?>