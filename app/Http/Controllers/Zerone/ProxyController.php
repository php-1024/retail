<?php
namespace App\Http\Controllers\Zerone;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
class ProxyController extends Controller{
    //添加服务商
    public function proxy_add(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        return view('Zerone/proxy/proxy_add',['admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'module','menu_data'=>$menu_data]);
    }

    //服务商审核列表
    public function proxy_examinelist(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        return view('Zerone/proxy/proxy_examinelist',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    //服务商审核列表
    public function proxy_examine(Request $request){
        echo "服务商审核数据提交";
    }

    //服务商列表
    public function proxy_list(Request $request){
        echo "服务商列表";
    }

}
?>