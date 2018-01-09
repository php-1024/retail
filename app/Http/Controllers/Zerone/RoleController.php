<?php
namespace App\Http\Controllers\Zerone;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Use App\Models\Module;
Use App\Models\OrganizationRole;
Use App\Models\RoleNode;
Use App\Models\OperationLog;
Use App\Models\ProgramModuleNode;
use Session;

class RoleController extends Controller{
    //添加权限角色
    public function role_add(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $module_node_list = Module::getListProgram(1,[],0,'id');//获取当前系统的所有模块和节点
        return view('Zerone/Role/role_add',['module_node_list'=>$module_node_list,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    //提交添加权限假设数据
    public function role_add_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $role_name = $request->input('role_name');
        $node_ids = $request->input('module_node_ids');
        if(OrganizationRole::checkRowExists([['organization_id',$admin_data['organization_id']],['created_by',$admin_data['id']],['role_name',$role_name]])){
            return response()->json(['data' => '您已经添加过相同的权限角色', 'status' => '0']);
        }else {
            DB::beginTransaction();
            try {
                $role_id = OrganizationRole::addRole(['program_id'=>1,'organization_id' => $admin_data['organization_id'], 'created_by' => $admin_data['id'], 'role_name' => $role_name]);//添加角色并获取它的ID
                foreach ($node_ids as $key => $val) {
                    RoleNode::addRoleNode(['role_id' => $role_id, 'node_id' => $val]);
                }
                OperationLog::addOperationLog('1',$admin_data['organization_id'],$admin_data['id'],$route_name,'添加了权限角色'.$role_name);//保存操作记录
                DB::commit();
            } catch (\Exception $e) {
                dump($e);
                DB::rollBack();//事件回滚
                return response()->json(['data' => '添加权限角色失败，请检查', 'status' => '0']);
            }
            return response()->json(['data' => '添加权限角色成功', 'status' => '1']);
        }
    }

    //权限角色列表
    public function role_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        $role_name = $request->input('role_name');
        $search_data = ['role_name'=>$role_name];
        //查询所有角色列表
        $list = OrganizationRole::getPaginage([['program_id',1],[ 'role_name','like','%'.$role_name.'%' ]],15,'id');

        //获取角色节点
        $role_module_nodes = [];
        foreach($list as $key=>$val){
            $role_module_nodes[$val->id] = $this->getModuleNode($val->id);//获取角色拥有的所有模块和节点
        }
        //获取零壹管理程序的所有模块及节点并组成数组。
        return view('Zerone/Role/role_list',['list'=>$list,'role_module_nodes'=>$role_module_nodes,'search_data'=>$search_data,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    /***
     * 私有方法：用于查询并组合角色拥有的权限模块和节点。
     * $role_id 当前角色的ID
     */
    private function getModuleNode($role_id){
        $list = ProgramModuleNode::getRoleModuleNodes(1,$role_id);
        $module_nodes = [];
        foreach($list as $key=>$val){
            $module_nodes[$val['module_name']][] = $val['node_name'];
        }
       return $module_nodes;
    }
    //编辑权限角色
    public function role_edit(Request $request){
        $id = $request->input('id');
        $info = OrganizationRole::getOne([['id',$id]]);
        $node_list = ProgramModuleNode::getRoleModuleNodes(1,$id);
        dump($node_list);
        $selected_nodes = [];//选中的节点
        $selected_modules = [];//选中的模块
        foreach($node_list as $key=>$val){
            $selected_nodes[] = $val->id;
        }
        $module_node_list = Module::getListProgram(1,[],0,'id');//获取当前系统的所有模块和节点
        return view('Zerone/Role/role_edit',['info'=>$info,'selected_nodes'=>$selected_nodes,'module_node_list'=>$module_node_list]);
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