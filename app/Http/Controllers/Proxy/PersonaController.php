<?php
namespace App\Http\Controllers\Proxy;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
class PersonaController extends Controller{
    //修改安全密码
    public function safe_password(Request $request){
        dd(1);
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        return view('Proxy/System/index',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);

    }
}
?>