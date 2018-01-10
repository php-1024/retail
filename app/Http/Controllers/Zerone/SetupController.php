<?php
namespace App\Http\Controllers\Zerone;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Session;


class SetupController extends Controller{
    //参数设置展示
    public function display(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $setup_list = Module::getListProgram(1,[],0,'id');//获取当前系统的所有模块和节点
        dump(Config::get('app.timezone'));
        return view('Zerone/Setup/display',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    //参数设置编辑
    public function setup_edit(Request $request){
        dd($request);
        echo "这里是参数设置编辑页面";
    }
}