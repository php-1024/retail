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
        return view('Program/Personal/edit_password',['admin_data'=>$admin_data,'route_name'=>$route_name]);
    }
}
?>