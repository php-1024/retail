<?php
namespace App\Http\Controllers\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\ProgramAdmin;
use App\Libraries\ZeroneLog\ProgramLog;

class PersonalController extends Controller{
    //修改个人密码
    public function edit_password(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $program_admin = new ProgramAdmin();
        $sql_password = $program_admin->where('',$admin_data['admin_id'])->pluck('password')->toArray();
        dump($sql_password);
        return view('Program/Personal/edit_password',['admin_data'=>$admin_data,'route_name'=>$route_name]);
    }
    //提交修改个人密码数据
    public function check_edit_password(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $oldpassword = $request->input('oldpassword');//原登录密码
        $password = $request->input('password');//新登录密码

        $encrypt_key = config("app.program_encrypt_key");//获取加密盐

        $old_encrypted = md5($oldpassword);//加密j旧密码第一重
        $old_encryptPwd = md5("lingyikeji".$old_encrypted.$encrypt_key);//加密旧密码第二重

        $program_admin = new ProgramAdmin();
        $sql_password = $program_admin->wehre('',$admin_data['admin_id'])->pluck('password')->toArray();

        $encrypted = md5($password);//加密密码第一重
        $encryptPwd = md5("lingyikeji".$encrypted.$encrypt_key);//加密密码第二重



    }
}
?>