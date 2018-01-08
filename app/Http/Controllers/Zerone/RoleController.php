<?php
namespace App\Http\Controllers\Zerone;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\Module;
use Session;

class RoleController extends Controller{
    //添加权限角色
    public function role_add(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $module_node_list = Module::getListProgram(1,[],0,'id');
        foreach($module_node_list as $key=>$val){
            dump($val->program_nodes);
        }
        return view('Zerone/Role/role_add',['module_node_list'=>$module_node_list,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    //提交添加权限假设数据
    public function role_add_check(Request $request){
        echo "这里是添加权限角色数据提交";
    }

    //权限角色列表
    public function role_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        return view('Zerone/Role/role_list',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    //编辑权限角色
    public function role_edit(Request $request){
        echo "这里是编辑权限角色";
    }

    //编辑权限角色提交
    public function role_edit_check(Request $request){
        echo "这里是编辑权限角色数据提交";
    }

    //删除权限角色
    public function role_delete(Request $request){
        echo "这是是删除权限角色检测";
    }
}