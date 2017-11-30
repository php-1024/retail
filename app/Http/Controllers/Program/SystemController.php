<?php
/**
 * 系统管理
 */
namespace App\Http\Controllers\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class SystemController extends Controller{
    public function dashboard(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        Session::put('zerone_program_account_id','');//存储登录session_id为当前用户ID
        return view('Program/System/dashboard',['admin_data'=>$admin_data]);
    }
}
?>