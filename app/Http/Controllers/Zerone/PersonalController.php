<?php
namespace App\Http\Controllers\Zerone;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class PersonalController extends Controller{
    //个人中心——个人资料
    public function display(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        dump($request);
        return view('Zerone/Personal/display',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }
    //个人中心——登录密码修改
    public function password_edit(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
//        dump($menu_data);

        return view('Zerone/Personal/password_edit',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }
    //个人中心——安全密码设置
    public function security_password(Request $request){
        dd('个人中心——安全密码设置');
    }
    //个人中心——我的操作日志
    public function operation_log(Request $request){
        dd('个人中心——我的操作日志');
    }
    //个人中心——我的登录日志
    public function login_log(Request $request){
        dd('个人中心——我的登录日志');
    }
}
?>