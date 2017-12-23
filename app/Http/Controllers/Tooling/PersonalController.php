<?php
namespace App\Http\Controllers\Tooling;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\ToolingAccount;
use App\Libraries\ZeroneLog\ToolingLog;
use App\Models\ToolingOperationLog;
use App\Models\ToolingLoginLog;

class PersonalController extends Controller{
    //修改个人密码
    public function password_edit(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        return view('Tooling/Personal/password_edit',['admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'personal']);
    }
    //提交修改个人密码数据
    public function password_edit_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $oldpassword = $request->input('oldpassword');//原登录密码
        $password = $request->input('password');//新登录密码

        $encrypt_key = config("app.tooling_encrypt_key");//获取加密盐

        $old_encrypted = md5($oldpassword);//加密j旧密码第一重
        $old_encryptPwd = md5("lingyikeji".$old_encrypted.$encrypt_key);//加密旧密码第二重

        $admin = new ToolingAccount();
        $sql_password = ToolingAccount::getPluck([[ 'id',$admin_data['admin_id'] ]] , 'password');
        $sql_password = $sql_password[0];//数组转化为字符串
        dump($sql_password);
        exit();
        if($old_encryptPwd != $sql_password){//判断原登录密码是否输入正确
            return response()->json(['data' => '原登录密码输入错误', 'status' => '0']);
        }

        $encrypted = md5($password);//加密新密码第一重
        $encryptPwd = md5("lingyikeji".$encrypted.$encrypt_key);//加密新密码第二重

        DB::beginTransaction();
        try{
            ToolingAccount::where('id',$admin_data['admin_id'])->update(['password'=>$encryptPwd]);//更新用户密码为新密码
            ToolingLog::setOperationLog($admin_data['admin_id'],$route_name,'修改了登录密码');
            DB::commit();
        }catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '修改登录密码失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '修改密码成功', 'status' => '1']);
    }

    //我的操作记录
    public function operation_log_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        $log = new ToolingOperationLog();//实例化模型

        $time_st = $request->input('time_st');//查询时间开始
        $time_nd = $request->input('time_nd');//查询时间结束
        $time_st_format = strtotime($time_st.' 00:00:00');
        $time_nd_format = strtotime($time_nd.' 23:59:59');

        $search_data = ['time_st'=>$time_st,'time_nd'=>$time_nd];

        $log = $log->where('account_id',$admin_data['admin_id']);
        if(!empty($time_st) && !empty($time_nd)){
            $log = $log->whereBetween('created_at',[$time_st_format,$time_nd_format]);
        }
        $list = $log->where('is_delete','0')->paginate(15);

        return view('Tooling/Personal/operation_log_list',['list'=>$list,'search_data'=>$search_data,'admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'personal']);
    }

    //所有登陆记录
    public function login_log_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        $log = new ToolingLoginLog();//实例化模型

        $time_st = $request->input('time_st');//查询时间开始
        $time_nd = $request->input('time_nd');//查询时间结束
        $time_st_format = strtotime($time_st.' 00:00:00');
        $time_nd_format = strtotime($time_nd.' 23:59:59');

        $search_data = ['time_st'=>$time_st,'time_nd'=>$time_nd];

        $log = $log->where('account_id',$admin_data['admin_id']);

        if(!empty($time_st) && !empty($time_nd)){
            $log = $log->whereBetween('created_at',[$time_st_format,$time_nd_format]);
        }

        $list = $log->where('is_delete','0')->paginate(15);
        return view('Tooling/Personal/login_log_list',['list'=>$list,'search_data'=>$search_data,'admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'personal']);
    }
}
?>