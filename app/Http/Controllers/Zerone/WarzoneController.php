<?php
namespace App\Http\Controllers\Zerone;
use App\Http\Controllers\Controller;
use App\Models\Warzone;
use App\Models\Module;
use App\Models\WarzoneProvince;
use Illuminate\Http\Request;
use Session;


class WarzoneController extends Controller{
    //战区管理首页
    public function display(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $zone_id = $request->input('$zone_id');
        $warzone = WarzoneProvince::getPaginage([[ 'zone_id','like','%'.$zone_id.'%' ]],15,'id');
        dump($warzone);
        return view('Zerone/Warzone/display',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }

    //功能模块列表
    public function module_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $module_name = $request->input('module_name');
        $search_data = ['module_name'=>$module_name];
        $list = Module::getPaginage([[ 'module_name','like','%'.$module_name.'%' ]],15,'id');
        dump($list);
        return view('Tooling/Module/module_list',['list'=>$list,'search_data'=>$search_data,'admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'module']);
    }
}