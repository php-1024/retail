<?php
/**
 * 系统管理
 */
namespace App\Http\Controllers\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\DB;

class SystemController extends Controller{
    //后台首页
    public function dashboard(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        return view('Program/System/dashboard',['admin_data'=>$admin_data,'route_name'=>$route_name]);
    }

    //新增账号
    public function account_add(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        return view('Program/System/account_add',['admin_data'=>$admin_data,'route_name'=>$route_name]);
    }

    //提交新增账号数据
    public function account_add_check(Request $request){
        $account = $request->input('account');
        $password = $request->input('password');

    }

    public function quit(Request $request){
        Session::put('zerone_program_account_id','');
        return redirect('program/login');
    }
}
?>