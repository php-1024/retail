<?php
/**
 *餐饮分店管理系统
 * 登录界面
 **/

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountInfo;
use App\Models\AccountNode;
use App\Models\Module;
use App\Models\OperationLog;
use App\Models\OrganizationRole;
use App\Models\ProgramModuleNode;
use App\Models\RoleAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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


    //添加下级人员数据提交
    public function subordinate_add_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        $password = $request->input('password');//登录密码
        $realname = $request->input('realname');//用户真实姓名
        $mobile = $request->input('mobile');//用户手机号码
        $role_id = $request->input('role_id');//用户角色ID
        $module_node_ids = $request->input('module_node_ids');//用户权限节点

        $key = config("app.branch_encrypt_key");//获取加密盐
        $encrypted = md5($password);//加密密码第一重
        $encryptPwd = md5("lingyikeji".$encrypted.$key);//加密密码第二重

        $parent_id = $admin_data['id'];//上级ID是当前用户ID
        $parent_tree = $admin_data['parent_tree'].$parent_id.',';//树是上级的树拼接上级的ID；
        $deepth = $admin_data['deepth']+1;
        $organization_id = $admin_data['organization_id'];//当前平台组织id

        $account = Account::max('account');
        $account = $account+1;
        if(Account::checkRowExists([[ 'account',$account ]])){//判断零壹管理平台中 ，判断组织中账号是否存在
            return response()->json(['data' => '账号生成错误，请重试', 'status' => '0']);
        }elseif(Account::checkRowExists([['organization_id',$organization_id],[ 'mobile',$mobile ]])) {//判断零壹管理平台中，判断组织中手机号码是否存在；
            return response()->json(['data' => '手机号码已存在', 'status' => '0']);
        }elseif(Account::checkRowExists([['organization_id','0'],[ 'mobile',$mobile ]])) {//判断手机号码是否超级管理员手机号码
            return response()->json(['data' => '手机号码已存在', 'status' => '0']);
        }else {
            DB::beginTransaction();
            try {
                //添加用户
                $account_id=Account::addAccount(['organization_id'=>$organization_id, 'parent_id'=>$parent_id, 'parent_tree'=>$parent_tree, 'deepth'=>$deepth, 'account'=>$account, 'password'=>$encryptPwd,'mobile'=>$mobile]);
                //添加用户个人信息
                AccountInfo::addAccountInfo(['account_id'=>$account_id,'realname'=>$realname]);
                //添加用户角色关系
                RoleAccount::addRoleAccount(['account_id'=>$account_id,'role_id'=>$role_id]);
                //添加用户权限节点关系
                foreach($module_node_ids as $key=>$val){
                    AccountNode::addAccountNode(['account_id'=>$account_id,'node_id'=>$val]);
                }
                if($admin_data['is_super'] == 2){
                    //添加操作日志
                    OperationLog::addOperationLog('1','1','1',$route_name,'在分店系统添加了下级人员：'.$account);//保存操作记录
                }else{
                    //添加操作日志
                    OperationLog::addOperationLog('5',$admin_data['organization_id'],$admin_data['id'],$route_name,'添加了下级人员：'.$account);//保存操作记录
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();//事件回滚
                return response()->json(['data' => '添加了下级人员失败，请检查', 'status' => '0']);
            }
            return response()->json(['data' => '添加下级人员成功，账号是：'.$account, 'status' => '1']);
        }
    }


    //编辑下级人员
    public function subordinate_edit(Request $request){
        $id = $request->input('id');
        $info = Account::getOne([['id',$id]]);
        return view('Branch/Subordinate/subordinate_edit',['info'=>$info]);
    }

    //编辑下级人员数据提交
    public function subordinate_edit_check(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');//要编辑的人员的ID
        $account = $request->input('account');
        $password = $request->input('password');//登录密码
        $realname = $request->input('realname');//真实姓名
        $mobile = $request->input('mobile');//手机号码
        $organization_id = $admin_data['organization_id'];
        if (!empty($password)) {
            $key = config("app.branch_encrypt_key");//获取加密盐
            $encrypted = md5($password);//加密密码第一重
            $encryptPwd = md5("lingyikeji" . $encrypted . $key);//加密密码第二重
            $data['password'] = $encryptPwd;
        }
        if(Account::checkRowExists([['id','<>',$id],['organization_id',$organization_id],[ 'mobile',$mobile ]])) {//判断零壹管理平台中，判断组织中手机号码是否存在；
            return response()->json(['data' => '手机号码已存在', 'status' => '0']);
        }elseif(Account::checkRowExists([['id','<>',$id],['organization_id','0'],[ 'mobile',$mobile ]])) {//判断手机号码是否超级管理员手机号码
            return response()->json(['data' => '手机号码已存在', 'status' => '0']);
        }else {
            DB::beginTransaction();
            try {
                //编辑用户
                $data['mobile'] = $mobile;
                Account::editAccount([[ 'id',$id]],$data);
                if(AccountInfo::checkRowExists([['account_id',$id]])) {
                    AccountInfo::editAccountInfo([['account_id', $id]], ['realname' => $realname]);
                }else{
                    AccountInfo::addAccountInfo(['account_id'=>$id,'realname'=>$realname]);
                }
                if($admin_data['is_super'] == 2){
                    //添加操作日志
                    OperationLog::addOperationLog('1','1','1',$route_name,'在分店系统编辑了下级人员：'.$account);//保存操作记录
                }else{
                    //添加操作日志
                    OperationLog::addOperationLog('5',$admin_data['organization_id'],$admin_data['id'],$route_name,'编辑了下级人员：'.$account);//保存操作记录
                }
                //添加操作日志
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();//事件回滚
                return response()->json(['data' => '编辑下级人员失败，请检查', 'status' => '0']);
            }
            return response()->json(['data' => '编辑下级人员成功', 'status' => '1']);
        }
    }


    //下级人员授权管理
    public function subordinate_authorize(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $id = $request->input('id');
        $info = Account::getOne([['id',$id]]);
        foreach($info->account_roles as $key=>$val){
            $info->account_role = $val->id;
        }
        $role_list = OrganizationRole::getList([['program_id',5],['created_by',$admin_data['id']]],0,'id');
        return view('Branch/Subordinate/subordinate_authorize',['info'=>$info,'role_list'=>$role_list]);
    }

    //下级人员列表
    public function subordinate_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $account = $request->input('account');
        $search_data = ['account'=>$account];
        $organization_id = $admin_data['organization_id'];//零壹管理平台只有一个组织
        $parent_tree = $admin_data['parent_tree'].$admin_data['id'].',';
        $list = Account::getPaginage([['organization_id',$organization_id],['parent_tree','like','%'.$parent_tree.'%'],[ 'account','like','%'.$account.'%' ]],15,'id');
        return view('Branch/Subordinate/subordinate_list',['list'=>$list,'search_data'=>$search_data,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
}

?>