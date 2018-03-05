<?php
/**
 *餐饮分店管理系统
 */

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Module;
use App\Models\ProgramModuleNode;
use Illuminate\Http\Request;
use Session;

class RoleController extends Controller
{
    //角色添加
    public function role_add(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                         //获取当前的页面路由

        $account_id = Account::getPluck([['organization_id',$admin_data['organization_id']],['parent_id',1]],'id')->first();
        dump($admin_data);
        dump($account_id);
        if($account_id != $admin_data['id']) {
            $module_node_list = Module::getListProgram(1, [], 0, 'id');//获取当前系统的所有模块和节点
        }else{
            $account_node_list = ProgramModuleNode::getAccountModuleNodes(7,$admin_data['id']);//获取当前用户具有权限的节点

            $modules = [];
            $nodes = [];
            $module_node_list = [];
            //过滤重复选出的节点和模块
            foreach($account_node_list as $key=>$val){
                $modules[$val->module_id] = $val->module_name;
                $nodes[$val->module_id][$val->node_id] = $val->node_name;
            }
            //遍历，整理为合适的格式
            foreach($modules as $key=>$val){
                $module = ['id'=>$key,'module_name'=>$val];
                foreach($nodes[$key] as $k=>$v){
                    $module['program_nodes'][] = array('id'=>$k,'node_name'=>$v);
                }
                $module_node_list[] = $module;
                unset($module);
            }
        }
        dump($module_node_list);
        return view('Branch/Role/role_add',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }

    //角色列表
    public function role_list(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                         //获取当前的页面路由
        return view('Branch/Role/role_list',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }
}

?>