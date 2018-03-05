<?php
/**
 *餐饮分店管理系统
 */

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Module;
use App\Models\OperationLog;
use App\Models\OrganizationRole;
use App\Models\ProgramModuleNode;
use App\Models\RoleNode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        return view('Branch/Role/role_add',['module_node_list'=>$module_node_list,'admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }

    //下级人员管理权限角色添加--功能提交
    public function role_add_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $role_name = $request->input('role_name');//权限角色名称
        $node_ids = $request->input('module_node_ids');//角色权限节点

        if(OrganizationRole::checkRowExists([['organization_id',$admin_data['organization_id']],['created_by',$admin_data['id']],['role_name',$role_name]])){//判断是否添加过相同的的角色
            return response()->json(['data' => '您已经添加过相同的权限角色名称', 'status' => '0']);
        }else {
            DB::beginTransaction();
            try {
                $role_id = OrganizationRole::addRole(['program_id'=>7,'organization_id' => $admin_data['organization_id'], 'created_by' => $admin_data['id'], 'role_name' => $role_name]);//添加角色并获取它的ID
                foreach ($node_ids as $key => $val) {
                    RoleNode::addRoleNode(['role_id' => $role_id, 'node_id' => $val]);
                }
                if($admin_data['is_super'] == 2){
                    OperationLog::addOperationLog('1','1','1',$route_name,'在店铺系统添加了权限角色'.$role_name);//保存操作记录
                }else{
                    OperationLog::addOperationLog('7',$admin_data['organization_id'],$admin_data['id'],$route_name,'添加了权限角色'.$role_name);//保存操作记录
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();//事件回滚
                return response()->json(['data' => '添加权限角色失败，请检查', 'status' => '0']);
            }
            return response()->json(['data' => '添加权限角色成功', 'status' => '1']);
        }
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