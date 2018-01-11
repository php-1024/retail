<?php
namespace App\Http\Controllers\Zerone;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrganizationRole;
use App\Models\Module;
use App\Models\ProgramModuleNode;
use App\Models\Account;
use App\Models\OperationLog;
use Session;
class SubordinateController extends Controller{
    //添加下级人员
    public function subordinate_add(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        //获取当前用户添加的权限角色
        $role_list = OrganizationRole::getList([['program_id',1],['created_by',$admin_data['id']]],0,'id');
        return view('Zerone/Subordinate/subordinate_add',['role_list'=>$role_list,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    //快速授权功能
    public function quick_rule(Request $request){
        $account_id = $request->input('account_id');
        $role_id = $request->input('role_id');
        if($account_id == 1) {//如果是超级管理员
            $module_node_list = Module::getListProgram(1, [], 0, 'id');//获取当前系统的所有模块和节点
        }else{
            $module_node_list = Module::getListProgram(1, [], 0, 'id');//其他用户暂时不做权限
        }
        $selected_nodes = [];//选中的节点
        $selected_modules = [];//选中的模块
        if($role_id <> '0'){
            $node_list = ProgramModuleNode::getRoleModuleNodes(1,$role_id);//获取当前角色拥有权限的模块和节点
            foreach($node_list as $key=>$val){
                $selected_modules[] = $val->module_id;
                $selected_nodes[] = $val->node_id;
            }
        }
        return view('Zerone/Subordinate/quick_rule',['module_node_list'=>$module_node_list,'selected_nodes'=>$selected_nodes,'selected_modules'=>$selected_modules]);
    }

    //添加下级人员数据提交
    public function subordinate_add_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        $account = $request->input('account');//用户账号
        $password = $request->input('password');//登陆密码
        $realname = $request->input('realname');//用户真实姓名
        $mobile = $request->input('mobile');//用户手机号码
        $role_id = $request->input('role_id');//用户角色ID
        $module_node_ids = $request->input('module_node_ids');//用户权限节点

        $organization_id = 1;//当前零壹管理平台就只有一个组织。
        if(Account::checkRowExists([['organization_id',$organization_id],[ 'account'=>$account ]])){//判断零壹管理平台中 ，判断组织中账号是否存在
            return response()->json(['data' => '账号已存在', 'status' => '0']);
        }elseif(Account::checkRowExists([['organization_id',$organization_id],[ 'mobile'=>$mobile ]])) {//判断零壹管理平台中，判断组织中手机号码是否存在；
            return response()->json(['data' => '手机号码已存在', 'status' => '0']);
        }elseif(Account::checkRowExists([['organization_id','0'],[ 'account'=>$account ]])) {//判断账号是否超级管理员账号
            return response()->json(['data' => '账号已存在', 'status' => '0']);
        }elseif(Account::checkRowExists([['organization_id','0'],[ 'mobile'=>$mobile ]])) {//判断手机号码是否超级管理员手机号码
            return response()->json(['data' => '手机号码已存在', 'status' => '0']);
        }else {
            DB::beginTransaction();
            try {

                OperationLog::addOperationLog('1',$admin_data['organization_id'],$admin_data['id'],$route_name,'编辑了权限角色');//保存操作记录
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();//事件回滚
                return response()->json(['data' => '编辑权限角色失败，请检查', 'status' => '0']);
            }
            return response()->json(['data' => '编辑权限角色成功', 'status' => '1']);
        }

    }

    //下级人员列表
    public function subordinate_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        return view('Zerone/Subordinate/subordinate_list',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    //编辑下级人员
    public function subordinate_edit(Request $request){
        echo "这里是编辑下级人员";
    }

    //编辑下级人员数据提交
    public function subordinate_edit_check(Request $request){
        echo "这里是编辑下级人员数据提交";
    }

    //冻结下级人员
    public function subordinate_lock(Request $request){
        echo "这里是冻结下级人员";
    }

    //删除下级人员
    public function subordinate_delete(Request $request){
        echo "这里是删除下级人员";
    }

    //下级人员结构
    public function subordinate_structure(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        return view('Zerone/Subordinate/subordinate_structure',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
}
?>