<?php
/**
 *餐饮分店管理系统
 * 登录界面
 **/

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Module;
use App\Models\OrganizationRole;
use App\Models\ProgramModuleNode;
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

    //快速授权功能
    public function quick_rule(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $role_id = $request->input('role_id');
        $account_id = Account::getPluck([['organization_id',$admin_data['organization_id']],['parent_id',1]],'id')->first();
        if($account_id == $admin_data['id']) {
            $module_node_list = Module::getListProgram(5, [], 0, 'id');//获取当前系统的所有模块和节点
        }else{
            $account_node_list = ProgramModuleNode::getAccountModuleNodes(5,$admin_data['id']);//获取当前用户具有权限的节点

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
        $selected_nodes = [];//选中的节点
        $selected_modules = [];//选中的模块
        if($role_id <> '0'){
            $node_list = ProgramModuleNode::getRoleModuleNodes(5,$role_id);//获取当前角色拥有权限的模块和节点
            foreach($node_list as $key=>$val){
                $selected_modules[] = $val->module_id;
                $selected_nodes[] = $val->node_id;
            }
        }
        return view('Branch/Subordinate/quick_rule',['module_node_list'=>$module_node_list,'selected_nodes'=>$selected_nodes,'selected_modules'=>$selected_modules]);
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