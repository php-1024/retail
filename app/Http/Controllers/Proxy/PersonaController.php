<?php
namespace App\Http\Controllers\Proxy;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Module;
use App\Models\OperationLog;
use App\Models\ProgramModuleNode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
class PersonaController extends Controller{


    //个人信息
    public function account_info(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $account_id = $admin_data['id'];//当前登录账号ID
        $user = Account::getOne([['id',$admin_data['id']]]);
        if($account_id == 1) {//如果是超级管理员
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
        dump($user);
        return view('Proxy/Persona/account_info',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);

    }

    //修改安全密码
    public function safe_password(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $admin_data['id'];
        if($admin_data['super_id'] == 2){
            $oneAcc = Account::getOne([['id',1]]);
        }else{
            $oneAcc = Account::getOne([['id',$id]]);
        }
        return view('Proxy/Persona/safe_password',['oneAcc'=>$oneAcc,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);

    }
    public function safe_password_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        $is_editing = $request->input('is_editing');    //是否修改安全密码
        $old_safe_password = $request->input('old_safe_password');    //原安全密码
        $safe_password = $request->input('safe_password');  //新安全密码

        if($admin_data['super_id'] ==2){
            $key = config("app.zerone_safe_encrypt_key");//获取加密盐
        }else{
            $key = config("app.proxy_safe_encrypt_key");//获取加密盐
        }
        $encrypted = md5($safe_password);//加密安全密码第一重
        $encryptPwd = md5("lingyikeji".$encrypted.$key);//加密安全密码第二重

        $old_encrypted = md5($old_safe_password);//加密原安全密码第一重
        $old_encryptPwd = md5("lingyikeji".$old_encrypted.$key);//加密原安全密码第二重
        if ($is_editing == '-1'){
            DB::beginTransaction();
            try {
                if($admin_data['super_id'] == 2){
                    Account::editAccount([['id',1]],['safe_password' => $encryptPwd]);
                    OperationLog::addOperationLog('1','1','1',$route_name,'在服务商系统设置了安全密码');//在零壹保存操作记录
                }else{
                    Account::editAccount([['id',$admin_data['id']]],['safe_password' => $encryptPwd]);
                    OperationLog::addOperationLog('1',$admin_data['organization_id'],$admin_data['id'],$route_name,'设置了安全密码');//保存操作记录
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();//事件回滚
                return response()->json(['data' => '设置安全密码失败，请检查', 'status' => '0']);
            }
            $admin_data['safe_password'] = $encryptPwd;
            \ZeroneRedis::create_proxy_account_cache($admin_data['id'],$admin_data);//生成账号数据的Redis缓存
            return response()->json(['data' => '安全密码设置成功', 'status' => '1']);
        }else{//修改安全密码
            if ($admin_data['safe_password'] == $old_encryptPwd){
                DB::beginTransaction();
                try {
                    if($admin_data['super_id'] == 2){
                        Account::editAccount([['id',1]],['safe_password' => $encryptPwd]);
                        OperationLog::addOperationLog('1','1','1',$route_name,'在服务商系统修改了安全密码');//在零壹保存操作记录
                    }else{
                        Account::editAccount([['id',$admin_data['id']]],['safe_password' => $encryptPwd]);
                        OperationLog::addOperationLog('2',$admin_data['organization_id'],$admin_data['id'],$route_name,'修改了安全密码');//保存操作记录
                    }
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();//事件回滚
                    return response()->json(['data' => '安全密码修改失败，请检查', 'status' => '0']);
                }
                $admin_data['safe_password'] = $encryptPwd;
                if($admin_data['super_id'] == 2) {
                    \ZeroneRedis::create_proxy_account_cache(1, $admin_data);//生成账号数据的Redis缓存
                }else{
                    \ZeroneRedis::create_proxy_account_cache($admin_data['id'], $admin_data);//生成账号数据的Redis缓存
                }
                return response()->json(['data' => '安全密码修改成功！', 'status' => '1']);
            }else{
                return response()->json(['data' => '原安全密码不正确！', 'status' => '0']);
            }
        }
    }
}
?>