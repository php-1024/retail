<?php
/**
 * 系统管理
 */
namespace App\Http\Controllers\Tooling;
use App\Models\OperationLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\ToolingAccount;
use App\Models\ToolingOperationLog;
use App\Models\ToolingLoginLog;
use App\Models\Node;
use App\Models\Module;
use App\Models\Program;
use App\Libraries\ZeroneLog\ToolingLog;

class SystemController extends Controller{
    //后台首页
    public function dashboard(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        $count_data = [];//统计数据
        $count_data['node_count'] = Node::getCount();//节点数量统计
        $count_data['module_count'] = Module::getCount();//模块数量统计
        $count_data['program_count'] = Program::getCount();//程序数量统计

        $where = [];
        if($admin_data['admin_is_super']!=1){   //不是超级管理员的时候，只查询自己相关的数据
            $where = [
                ['account_id',$admin_data['admin_id']]
            ];
        }
        $login_log_list = ToolingLoginLog::getList($where,10,'id');//登录记录
        $operation_log_list = ToolingOperationLog::getList($where,10,'id');//操作记录

        return view('Tooling/System/dashboard',['count_data'=>$count_data,'operation_log_list'=>$operation_log_list,'login_log_list'=>$login_log_list,'admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'system']);
    }

    //新增账号
    public function account_add(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        return view('Tooling/System/account_add',['admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'system']);
    }

    //提交新增账号数据
    public function account_add_check(Request $request){
        $account = $request->input('account');//获取账号
        $password = $request->input('password');//获取密码
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        $encrypt_key = config("app.tooling_encrypt_key");//获取加密盐
        $encrypted = md5($password);//加密密码第一重
        $encryptPwd = md5("lingyikeji".$encrypted.$encrypt_key);//加密密码第二重

        if(ToolingAccount::checkRowExists([[ 'account' , $account  ]])){//如果存在相同的账号则报错
            return response()->json(['data' => '该账号已存在', 'status' => '0']);
        }else{
            DB::beginTransaction();
            try{
                ToolingAccount::addAccount(['account'=>$account,'password'=>$encryptPwd]);
                ToolingOperationLog::addOperationLog($admin_data['admin_id'],$route_name,'新增了管理员账号'.$account);
                DB::commit();
            }catch (\Exception $e) {
                DB::rollBack();//事件回滚
                return response()->json(['data' => '添加账号失败，请检查', 'status' => '0']);
            }
        }
        return response()->json(['data' => '添加账号成功', 'status' => '1']);
    }

    //账号列表
    public function account_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $account = $request->input('account');//通过登录页账号查询
        $search_data = ['account'=>$account];//分页带的数据
        $where = [];
        if(!empty($account)){
            $where[] = ['account','like','%'.$account.'%'];
        }
        $list = ToolingAccount::getPaginage($where,15,'id');//获取账号数据分页
        return view('Tooling/System/account_list',['list'=>$list,'search_data'=>$search_data,'admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'system']);
    }

    //编辑账号
    public function account_edit(Request $request){
        $id = $request->input('id');
        $info = ToolingAccount::find($id);
        return view('Tooling/System/account_edit',['info'=>$info]);
    }

    //提交编辑账号数据
    public function account_edit_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $account = $request->input('account');//要操作的管理员的账号,用于记录
        $id = $request->input('id');//要操作的管理员的ID
        $password = $request->input('password');//新登录页密码
        $encrypt_key = config("app.tooling_encrypt_key");//获取加密盐
        $encrypted = md5($password);//加密密码第一重
        $encryptPwd = md5("lingyikeji".$encrypted.$encrypt_key);//加密密码第二重

        DB::beginTransaction();
        try{
            ToolingAccount::editAccount([['id',$id]],['password'=>$encryptPwd]);
            ToolingOperationLog::addOperationLog($admin_data['admin_id'],$route_name,'修改了'.$account.'的密码');
            DB::commit();
        }catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '编辑账号失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '编辑账号成功', 'status' => '1']);
    }

    //冻结解冻管理员
    public function account_lock(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');//要操作的管理员的ID
        $account = $request->input('account');//要操作的管理员的账号,用于记录
        $account_status = $request->input('account_status');//当前用户的状态
        DB::beginTransaction();
        try{
            if($account_status==1) {
                ToolingAccount::editAccount([['id',$id]],['status'=>'0']);
                ToolingOperationLog::addOperationLog($admin_data['admin_id'], $route_name, '冻结了管理员账号' . $account . '');
            }else{
                ToolingAccount::editAccount([['id',$id]],['status'=>'1']);
                ToolingOperationLog::addOperationLog($admin_data['admin_id'], $route_name, '解冻了管理员账号' . $account . '');
            }
            DB::commit();
        }catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '操作失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '操作成功', 'status' => '1']);
    }

    //所有操作记录
    public function operation_log_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $account = $request->input('account');//通过登录页账号查询
        $time_st = $request->input('time_st');//查询时间开始
        $time_nd = $request->input('time_nd');//查询时间结束
        $time_st_format = $time_nd_format = 0;//实例化时间格式
        if(!empty($time_st) && !empty($time_nd)) {
            $time_st_format = strtotime($time_st . ' 00:00:00');//开始时间转时间戳
            $time_nd_format = strtotime($time_nd . ' 23:59:59');//结束时间转时间戳
        }
        $search_data = ['account'=>$account,'time_st'=>$time_st,'time_nd'=>$time_nd];
        $list=ToolingOperationLog::getUnionPaginate($account,$time_st_format,$time_nd_format,15,'id');
        return view('Tooling/System/operation_log_list',['list'=>$list,'search_data'=>$search_data,'admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'system']);
    }

    //所有登录记录
    public function login_log_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $account = $request->input('account');//通过登录页账号查询
        $time_st = $request->input('time_st');//查询时间开始
        $time_nd = $request->input('time_nd');//查询时间结束
        $time_st_format = $time_nd_format = 0;//实例化时间格式
        if(!empty($time_st) && !empty($time_nd)) {
            $time_st_format = strtotime($time_st . ' 00:00:00');//开始时间转时间戳
            $time_nd_format = strtotime($time_nd . ' 23:59:59');//结束时间转时间戳
        }
        $search_data = ['account'=>$account,'time_st'=>$time_st,'time_nd'=>$time_nd];
        $list = ToolingLoginLog::getUnionPaginate($account,$time_st_format,$time_nd_format,15,'id');
        return view('Tooling/System/login_log_list',['list'=>$list,'search_data'=>$search_data,'admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'system']);
    }

    //退出登录
    public function quit(Request $request){
        Session::put('tooling_account_id','');
        return redirect('tooling/login');
    }
}
?>