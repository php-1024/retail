<?php
/**
 *餐饮分店管理系统
 * 登录界面
 **/

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\OrganizationRole;
use Illuminate\Http\Request;
use Session;

class SubordinateController extends Controller
{
    //下属添加
    public function subordinate_add(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        //获取当前用户添加的权限角色
        $role_list = OrganizationRole::getList([['program_id',5],['created_by',$admin_data['id']]],0,'id');
        $module_node_list = Module::getListProgram(5, [], 0, 'id');//获取当前系统的所有模块和节点
        $selected_modules = [];//选中的模块
        $selected_nodes = [];//选中的节点
        return view('Branch/Subordinate/subordinate_add',['selected_nodes'=>$selected_nodes,'selected_modules'=>$selected_modules,'module_node_list'=>$module_node_list,'role_list'=>$role_list,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    //下级人员列表
    public function subordinate_list(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        return view('Branch/Subordinate/subordinate_list',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }
}

?>