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
use App\Libraries\ZeroneLog\ToolingLog;

class SystemController extends Controller{
    //后台首页
    public function dashboard(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        $where = [];
        if($admin_data['admin_is_super']!=1){   //不是超级管理员的时候，只查询自己相关的数据
            $where = [
                ['account_id'=>$admin_data['admin_id']]
            ];
        }

        $login_log_list = ToolingLoginLog::getList($where,10,'id');

        return view('Tooling/System/dashboard',['$login_log_list'=>$login_log_list,'admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'system']);
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

        $admin = new ToolingAccount();//实例化模型
        $info = $admin->where('account',$account)->where('is_delete','0')->pluck('id')->toArray();//查询是否有相同的账号存在

        if(!empty($info)){//如果存在报错
            return response()->json(['data' => '该账号已存在', 'status' => '0']);
        }else{
            DB::beginTransaction();
            try{
                $admin = new ToolingAccount();//重新实例化模型，避免重复
                $admin->account = $account;
                $admin->password = $encryptPwd;
                $admin->save();//添加账号
                ToolingLog::setOperationLog($admin_data['admin_id'],$route_name,'新增了管理员账号'.$account);
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

        $search_data = ['account'=>$account];
        $admin = new ToolingAccount();//实例化模型
        if(!empty($account)){
            $admin = $admin->where('account','like','%'.$account.'%');
        }
        $list = $admin->where('is_delete','0')->where('id','!=',$admin_data['admin_id'])->paginate(15);

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
            $admin = new ToolingAccount();//重新实例化模型，避免重复
            $admin->where('id',$id)->update(['password'=>$encryptPwd]);//添加账号
            ToolingLog::setOperationLog($admin_data['admin_id'],$route_name,'修改了'.$account.'的密码');
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
            $admin = new ToolingAccount();//重新实例化模型，避免重复
            if($account_status==1) {
                $admin->where('id', $id)->update(['status' => '0']);//添加账号
                ToolingLog::setOperationLog($admin_data['admin_id'], $route_name, '冻结了管理员账号' . $account . '');
            }else{
                $admin->where('id', $id)->update(['status' => '1']);//添加账号
                ToolingLog::setOperationLog($admin_data['admin_id'], $route_name, '解冻了管理员账号' . $account . '');
            }
            DB::commit();
        }catch (\Exception $e) {
            dump($e);
            DB::rollBack();//事件回滚
            return response()->json(['data' => '操作失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '操作成功', 'status' => '1']);
    }

    //所有操作记录
    public function operation_log_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数

        $route_name = $request->path();//获取当前的页面路由
        $log = new ToolingOperationLog();//实例化模型
        $account = $request->input('account');//通过登录页账号查询
        $time_st = $request->input('time_st');//查询时间开始
        $time_nd = $request->input('time_nd');//查询时间结束
        $time_st_format = strtotime($time_st.' 00:00:00');
        $time_nd_format = strtotime($time_nd.' 23:59:59');

        $search_data = ['account'=>$account,'time_st'=>$time_st,'time_nd'=>$time_nd];

        if(!empty($account)){
            $log = $log->where('account','like','%'.$account.'%');
        }
        if(!empty($time_st) && !empty($time_nd)){
            $log = $log->whereBetween('tooling_operation_log.created_at',[$time_st_format,$time_nd_format]);
        }


        $list = $log->join('tooling_account',function($join){
            $join->on('tooling_operation_log.account_id','=','tooling_account.id');
        })->select('tooling_account.account','tooling_operation_log.*')->paginate(15);
        return view('Tooling/System/operation_log_list',['list'=>$list,'search_data'=>$search_data,'admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'system']);
    }

    //所有登陆记录
    public function login_log_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        $log = new ToolingLoginLog();//实例化模型

        $account = $request->input('account');//通过登录页账号查询
        $time_st = $request->input('time_st');//查询时间开始
        $time_nd = $request->input('time_nd');//查询时间结束
        $time_st_format = strtotime($time_st.' 00:00:00');
        $time_nd_format = strtotime($time_nd.' 23:59:59');

        $search_data = ['account'=>$account,'time_st'=>$time_st,'time_nd'=>$time_nd];

        if(!empty($account)){
            $log = $log->where('account','like','%'.$account.'%');
        }
        if(!empty($time_st) && !empty($time_nd)){
            $log = $log->whereBetween('tooling_login_log.created_at',[$time_st_format,$time_nd_format]);
        }


        $list = $log->join('tooling_account',function($join){
            $join->on('tooling_login_log.account_id','=','tooling_account.id');
        })->select('tooling_account.account','tooling_login_log.*')->paginate(15);
        return view('Tooling/System/login_log_list',['list'=>$list,'search_data'=>$search_data,'admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'system']);
    }

    //退出登录
    public function quit(Request $request){
        Session::put('zerone_tooling_account_id','');
        return redirect('tooling/login');
    }
}
?>