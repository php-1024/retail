<?php
namespace App\Http\Controllers\Proxy;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
class SystemController extends Controller{
    //添加服务商
    public function display(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        if($admin_data['super_id'] == 1){
            return view('Proxy/System/select_proxy');
        }else{
            return view('Proxy/System/index',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
        }
    }

    //退出登录
    public function quit(Request $request){
        Session::put('tooling_account_id','');
        return redirect('proxy/login');
    }
}
?>