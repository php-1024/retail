<?php
namespace App\Http\Controllers\Zerone;
use App\Http\Controllers\Controller;
use App\Models\Setup;
use Illuminate\Http\Request;
use Session;


class SetupController extends Controller{
    //参数设置展示
    public function display(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $setup_list = Setup::get_all();
        return view('Zerone/Setup/display',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name,'setup_list'=>$setup_list]);
    }
    //参数设置编辑
    public function setup_edit_check(Request $request){
        dd($request);
        $cfg_value_arr = $request->input('cfg_value');
        echo "这里是参数设置编辑页面";
    }
}