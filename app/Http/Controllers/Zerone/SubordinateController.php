<?php
namespace App\Http\Controllers\Zerone;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\OrganizationRole;
use App\Models\Module;
use App\Models\ProgramModuleNode;
use App\Models\Account;
use App\Models\AccountNode;
use App\Models\AccountInfo;
use App\Models\RoleAccount;
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

        $key = config("app.zerone_encrypt_key");//获取加密盐
        $encrypted = md5($password);//加密密码第一重
        $encryptPwd = md5("lingyikeji".$encrypted.$key);//加密密码第二重

        $parent_id = $admin_data['id'];//上级ID是当前用户ID
        $parent_tree = $admin_data['parent_tree'].','.$parent_id;//树是上级的树拼接上级的ID；
        $deepth = $admin_data['deepth']+1;
        $organization_id = 1;//当前零壹管理平台就只有一个组织。

        if(Account::checkRowExists([[ 'account',$account ]])){//判断零壹管理平台中 ，判断组织中账号是否存在
            return response()->json(['data' => '账号已存在', 'status' => '0']);
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
                //添加操作日志
                OperationLog::addOperationLog('1',$admin_data['organization_id'],$admin_data['id'],$route_name,'添加了下级人员：'.$account);//保存操作记录
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();//事件回滚
                return response()->json(['data' => '添加了下级人员失败，请检查', 'status' => '0']);
            }
            return response()->json(['data' => '添加下级人员成功', 'status' => '1']);
        }
    }

    //下级人员列表
    public function subordinate_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $account = $request->input('account');
        $search_data = ['account'=>$account];
        $organization_id = 1;//零壹管理平台只有一个组织
        $parent_tree = $admin_data['parent_tree'].','.$admin_data['id'];
        $list = Account::getPaginage([['organization_id',$organization_id],['parent_tree','like','%'.$parent_tree.'%'],[ 'account','like','%'.$account.'%' ]],15,'id');

        return view('Zerone/Subordinate/subordinate_list',['list'=>$list,'search_data'=>$search_data,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    //编辑下级人员
    public function subordinate_edit(Request $request){
        $id = $request->input('id');
        $info = Account::getOne([['id',$id]]);
        return view('Zerone/Subordinate/subordinate_edit',['info'=>$info]);
    }

    //编辑下级人员数据提交
    public function subordinate_edit_check(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');//要编辑的人员的ID
        $account = $request->input('account');
        $password = $request->input('password');//登陆密码
        $realname = $request->input('realname');//真实姓名
        $mobile = $request->input('mobile');//手机号码
        $organization_id = 1;
        if (!empty($password)) {
            $key = config("app.zerone_encrypt_key");//获取加密盐
            $encrypted = md5($password);//加密密码第一重
            $encryptPwd = md5("lingyikeji" . $encrypted . $key);//加密密码第二重
        }
       if(Account::checkRowExists([['id','<>',$id],['organization_id',$organization_id],[ 'mobile',$mobile ]])) {//判断零壹管理平台中，判断组织中手机号码是否存在；
            return response()->json(['data' => '手机号码已存在', 'status' => '0']);
        }elseif(Account::checkRowExists([['id','<>',$id],['organization_id','0'],[ 'mobile',$mobile ]])) {//判断手机号码是否超级管理员手机号码
            return response()->json(['data' => '手机号码已存在', 'status' => '0']);
        }else {
            DB::beginTransaction();
            try {
                //添加用户
                $data['mobile'] = $mobile;
                if (!empty($password)) {
                    $data['password'] = $encryptPwd;
                }
                Account::editAccount([[ 'id',$id]],$data);
                AccountInfo::editAccountInfo([['account_id',$id]],['realname'=>$realname]);
                //添加操作日志
                OperationLog::addOperationLog('1',$admin_data['organization_id'],$admin_data['id'],$route_name,'编辑了下级人员：'.$account);//保存操作记录
                DB::commit();
            } catch (\Exception $e) {
                dump($e);
                DB::rollBack();//事件回滚
                return response()->json(['data' => '编辑下级人员失败，请检查', 'status' => '0']);
            }
            return response()->json(['data' => '编辑下级人员成功', 'status' => '1']);
        }
    }

    //输入安全密码判断是否能冻结的页面
    public function subordinate_lock_confirm(Request $request){
        $id = $request->input('id');
        return view('Zerone/Subordinate/subordinate_lock_confirm',['id'=>$id]);
    }
    //冻结解冻下级人员
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