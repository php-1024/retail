<?php
namespace App\Http\Controllers\Zerone;
Use App\Http\Controllers\Controller;
Use Illuminate\Http\Request;
Use Illuminate\Support\Facades\DB;
Use App\Models\Module;
Use App\Models\OrganizationRole;
Use App\Models\RoleNode;
Use App\Models\OperationLog;
Use App\Models\ProgramModuleNode;
Use App\Models\RoleAccount;
Use Session;

class RoleController extends Controller{
    //添加权限角色
    public function role_add(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        if($admin_data['id'] == 1) {
            $module_node_list = Module::getListProgram(1, [], 0, 'id');//获取当前系统的所有模块和节点
        }else{
            $account_node_list = ProgramModuleNode::getAccountModuleNodes(1,$admin_data['id']);//获取当前用户具有权限的节点

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

        return view('Zerone/Role/role_add',['module_node_list'=>$module_node_list,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    //提交添加权限假设数据
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
                $role_id = OrganizationRole::addRole(['program_id'=>1,'organization_id' => $admin_data['organization_id'], 'created_by' => $admin_data['id'], 'role_name' => $role_name]);//添加角色并获取它的ID
                foreach ($node_ids as $key => $val) {
                    RoleNode::addRoleNode(['role_id' => $role_id, 'node_id' => $val]);
                }
                OperationLog::addOperationLog('1',$admin_data['organization_id'],$admin_data['id'],$route_name,'添加了权限角色'.$role_name);//保存操作记录
                DB::commit();
            } catch (\Exception $e) {
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
        $list = OrganizationRole::getPaginage([['created_by',$admin_data['id']],['program_id',1],[ 'role_name','like','%'.$role_name.'%' ]],15,'id');

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
            $module_nodes[$val['module_show_name']][] = $val['node_show_name'];
        }
       return $module_nodes;
    }
    //编辑权限角色
    public function role_edit(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $id = $request->input('id');//权限角色ID
        $info = OrganizationRole::getOne([['id',$id]]);//获取该ID的信息
        $node_list = ProgramModuleNode::getRoleModuleNodes(1,$id);//获取当前角色拥有权限的模块和节点
        $selected_nodes = [];//选中的节点
        $selected_modules = [];//选中的模块

        foreach($node_list as $key=>$val){
            $selected_modules[] = $val->module_id;
            $selected_nodes[] = $val->node_id;
        }

        if($admin_data['id'] == 1) {
            $module_node_list = Module::getListProgram(1, [], 0, 'id');//获取当前系统的所有模块和节点
        }else{
            $account_node_list = ProgramModuleNode::getAccountModuleNodes(1,$admin_data['id']);//获取当前用户具有权限的节点
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
        return view('Zerone/Role/role_edit',['info'=>$info,'selected_modules'=>$selected_modules,'selected_nodes'=>$selected_nodes,'module_node_list'=>$module_node_list]);
    }

    //编辑权限角色提交
    public function role_edit_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');//要编辑的角色ID
        $role_name = $request->input('role_name');//权限角色名称
        $node_ids = $request->input('module_node_ids');//角色权限节点

        if(OrganizationRole::checkRowExists([['id','<>',$id],['organization_id',$admin_data['organization_id']],['created_by',$admin_data['id']],['role_name',$role_name]])){//判断非本条数据是否有相同的的角色
            return response()->json(['data' => '存在另一个相同的权限角色名称', 'status' => '0']);
        }else {
            DB::beginTransaction();
            try {
                OrganizationRole::editRole([['id',$id]],['role_name' => $role_name]);//修改角色名称
                foreach ($node_ids as $key => $val) {
                    $vo = RoleNode::getOne([['role_id',$id],['node_id',$val]]);//查询是否存在数据
                    if(is_null($vo)) {//不存在生成插入数据
                        RoleNode::addRoleNode(['role_id' => $id, 'node_id' => $val]);
                    }else{//存在数据则跳过
                        continue;
                    }
                }
                RoleNode::where('role_id', $id)->whereNotIn('node_id', $node_ids)->forceDelete();
                OperationLog::addOperationLog('1',$admin_data['organization_id'],$admin_data['id'],$route_name,'编辑了权限角色'.$role_name);//保存操作记录
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();//事件回滚
                return response()->json(['data' => '编辑权限角色失败，请检查', 'status' => '0']);
            }
            return response()->json(['data' => '编辑权限角色成功', 'status' => '1']);
        }
    }

    //直接输入安全密码操作的页面--删除
    public function role_delete_comfirm(Request $request){
        $id = $request->input('id');
        return view('Zerone/Role/role_delete_comfirm',['id'=>$id]);
    }

    //删除权限角色
    public function role_delete(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');//提交上来的ID
        DB::beginTransaction();
        try{
            OrganizationRole::where('id',$id)->delete();//删除权限角色
            RoleNode::where('role_id',$id)->delete();//删除角色节点关系
            RoleAccount::where('role_id',$id)->delete();//删除角色账号关系
            OperationLog::addOperationLog('1',$admin_data['organization_id'],$admin_data['id'],$route_name,'删除了权限角色，ID为：'.$id);//保存操作记录
            DB::commit();//提交事务
        }catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '删除权限角色失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '删除权限角色成功', 'status' => '1']);
    }
}